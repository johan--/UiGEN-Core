<?php 
if ( !function_exists('wp_salt') ) :
/**
 * Get salt to add to hashes.
 *
 * Salts are created using secret keys. Secret keys are located in two places:
 * in the database and in the wp-config.php file. The secret key in the database
 * is randomly generated and will be appended to the secret keys in wp-config.php.
 *
 * The secret keys in wp-config.php should be updated to strong, random keys to maximize
 * security. Below is an example of how the secret key constants are defined.
 * Do not paste this example directly into wp-config.php. Instead, have a
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ secret key created} just
 * for you.
 *
 * <code>
 * define('AUTH_KEY',         ' Xakm<o xQy rw4EMsLKM-?!T+,PFF})H4lzcW57AF0U@N@< >M%G4Yt>f`z]MON');
 * define('SECURE_AUTH_KEY',  'LzJ}op]mr|6+![P}Ak:uNdJCJZd>(Hx.-Mh#Tz)pCIU#uGEnfFz|f ;;eU%/U^O~');
 * define('LOGGED_IN_KEY',    '|i|Ux`9<p-h$aFf(qnT:sDO:D1P^wZ$$/Ra@miTJi9G;ddp_<q}6H1)o|a +&JCM');
 * define('NONCE_KEY',        '%:R{[P|,s.KuMltH5}cI;/k<Gx~j!f0I)m_sIyu+&NJZ)-iO>z7X>QYR0Z_XnZ@|');
 * define('AUTH_SALT',        'eZyT)-Naw]F8CwA*VaW#q*|.)g@o}||wf~@C-YSt}(dh_r6EbI#A,y|nU2{B#JBW');
 * define('SECURE_AUTH_SALT', '!=oLUTXh,QW=H `}`L|9/^4-3 STz},T(w}W<I`.JjPi)<Bmf1v,HpGe}T1:Xt7n');
 * define('LOGGED_IN_SALT',   '+XSqHc;@Q*K_b|Z?NC[3H!!EONbh.n<+=uKR:>*c(u`g~EJBf#8u#R{mUEZrozmm');
 * define('NONCE_SALT',       'h`GXHhD>SLWVfg1(1(N{;.V!MoE(SfbA_ksP@&`+AycHcAV$+?@3q+rxV{%^VyKT');
 * </code>
 *
 * Salting passwords helps against tools which has stored hashed values of
 * common dictionary strings. The added values makes it harder to crack.
 *
 * @since 2.5
 *
 * @link https://api.wordpress.org/secret-key/1.1/salt/ Create secrets for wp-config.php
 *
 * @param string $scheme Authentication scheme (auth, secure_auth, logged_in, nonce)
 * @return string Salt value
 */
function wp_salt( $scheme = 'auth' ) {
	static $cached_salts = array();
	if ( isset( $cached_salts[ $scheme ] ) )
		return apply_filters( 'salt', $cached_salts[ $scheme ], $scheme );

	static $duplicated_keys;
	if ( null === $duplicated_keys ) {
		$duplicated_keys = array( 'put your unique phrase here' => true );
		foreach ( array( 'AUTH', 'SECURE_AUTH', 'LOGGED_IN', 'NONCE', 'SECRET' ) as $first ) {
			foreach ( array( 'KEY', 'SALT' ) as $second ) {
				if ( ! defined( "{$first}_{$second}" ) )
					continue;
				$value = constant( "{$first}_{$second}" );
				$duplicated_keys[ $value ] = isset( $duplicated_keys[ $value ] );
			}
		}
	}

	$key = $salt = '';
	if ( defined( 'SECRET_KEY' ) && SECRET_KEY && empty( $duplicated_keys[ SECRET_KEY ] ) )
		$key = SECRET_KEY;
	if ( 'auth' == $scheme && defined( 'SECRET_SALT' ) && SECRET_SALT && empty( $duplicated_keys[ SECRET_SALT ] ) )
		$salt = SECRET_SALT;

	if ( in_array( $scheme, array( 'auth', 'secure_auth', 'logged_in', 'nonce' ) ) ) {
		foreach ( array( 'key', 'salt' ) as $type ) {
			$const = strtoupper( "{$scheme}_{$type}" );
			if ( defined( $const ) && constant( $const ) && empty( $duplicated_keys[ constant( $const ) ] ) ) {
				$$type = constant( $const );
			} elseif ( ! $$type ) {
				$$type = get_site_option( "{$scheme}_{$type}" );
				if ( ! $$type ) {
					$$type = wp_generate_password( 64, true, true );
					update_site_option( "{$scheme}_{$type}", $$type );
				}
			}
		}
	} else {
		if ( ! $key ) {
			$key = get_site_option( 'secret_key' );
			if ( ! $key ) {
				$key = wp_generate_password( 64, true, true );
				update_site_option( 'secret_key', $key );
			}
		}
		$salt = hash_hmac( 'sha256', $scheme, $key );
	}

	$cached_salts[ $scheme ] = $key . $salt;
	return apply_filters( 'salt', $cached_salts[ $scheme ], $scheme );
}
endif;

if ( !function_exists('wp_hash_password') ) :
/**
 * Create a hash (encrypt) of a plain text password.
 *
 * For integration with other applications, this function can be overwritten to
 * instead use the other package password checking algorithm.
 *
 * @since 3.5
 *
 * @param string $password Plain text user password to hash
 * @return string The hash string of the password
 */
function wp_hash_password($password) {
	return hash_hmac('sha256', $password, wp_salt('auth'));
}
endif;

if ( !function_exists('wp_check_password') ) :
/**
 * Checks the plaintext password against the encrypted Password.
 *
 * Maintains compatibility between old version and the new cookie authentication
 * protocol using PHPass library. The $hash parameter is the encrypted password
 * and the function compares the plain text password when encrypted similarly
 * against the already encrypted password to see if they match.
 *
 * For integration with other applications, this function can be overwritten to
 * instead use the other package password checking algorithm.
 *
 * @since 3.5
 * @param string $password Plaintext user's password
 * @param string $hash Hash of the user's password to check against.
 * @return bool False, if the $password does not match the hashed password
 */
function wp_check_password($password, $hash, $user_id = '') {
	global $wp_hasher;

	// If the hash is still md5...
	if ( strlen($hash) <= 32 ) {
		$check = ( $hash == md5($password) );
		if ( $check && $user_id ) {
			// Rehash using new hash.
			wp_set_password($password, $user_id);
			$hash = wp_hash_password($password);
		}

		return apply_filters('check_password', $check, $password, $hash, $user_id);
	}

	$check = ( $hash == hash_hmac('sha256', $password, wp_salt('auth')) );

	return apply_filters('check_password', $check, $password, $hash, $user_id);
}
endif;