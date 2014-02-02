  <h3>1. Lista dostępnych bloczków</h3>
  <p style="font-size:11px"> bloczki to posttype z definicjami bloczków jakich możemy użyć w systemie. Po użyciu bloczku następuje wygenerowanie instancji bloczka w systemie - tworzymy kolejny posttype<p>
  <table class="wp-list-table widefat plugins">
    <thead>
    <tr>
      <th>Nazwa bloczku <br/>jest to plik wskazany w shemie</th></th><th>Schema opcji konfiguracyjnych</th></th><th>Akcje</th>
    </tr>
    </thead>
    <tbody id="the-list">
    <tr class="active">
      <td>Logo  </td> <td>Schema-logo</td><td><button class="button">Użyj</button></td>
    </tr>
    <tr class="active">
      <td>Menu</td>  <td>Schema-menu</td><td><button class="button">Użyj</button>
    </tr>
    <tr class="active">
      <td>Lista</td>  <td>Schema-loop</td><td><button class="button">Użyj</button>
    </tr>
    <tr class="active">
      <td>Content</td>  <td>Schema-content</td><td><button class="button">Użyj</button>
    </tr>
    <tr class="inactive">
      <td>Karuzela</td>  <td>Schema-slider</td><td><button class="button">Użyj</button>
    </tr>    
    </tbody>  
  </table>


  <h3>2. Lista wybranych (używanych) bloczków</h3>
  <p style="font-size:11px"> lista wybranych bloczków z tabeli powyżej - pozwala zarządzać oraz konfigurować wybrane bloczki.<p>
  <table class="wp-list-table widefat plugins">
    <thead>
    <tr>
      <th>Nazwa instancji wybranego bloczka <br/></th></th><th>referencja do id bloczka źródłowego</th><th>Parametry</th></th><th>Akcje</th>
    </tr>
    </thead>
    <tbody id="the-list">
    <tr class="inactive">
      <td>Logo - instancja1 </td> <td>Logo</td><td>Domyślne</td><td><button class="button">Edytuj</button><button class="button">Usuń</button></td>
    </tr>
    <tr class="inactive">
      <td>Menu - instancja1</td>  <td>Menu</td><td>Domyślne</td><td><button class="button">Edytuj</button><button class="button">Usuń</button>
    </tr>
     <tr class="active">
      <td>Menu - instancja2</td>  <td>Menu</td><td>Definiowane przez usera</td><td><button class="button">Edytuj</button><button class="button">Usuń</button>
    </tr>
    <tr class="inactive">
      <td>Lista - instancja1</td>  <td>Lista</td><td>Domyślne</td><td><button class="button">Edytuj</button><button class="button">Usuń</button>
    </tr>
    <tr class="inactive">
      <td>Content - instancja1</td>  <td>Content</td><td>Domyślne</td><td><button class="button">Edytuj</button><button class="button">Usuń</button>
    </tr>  
    </tbody>  
  </table>






  <h3>3 Komponuj układ strony</h3>
  <table class="wp-list-table widefat plugins">
    <thead>
    <tr>
      <th>Nazwa pliku <br/>jest to plik wskazany w shemie</th></th><th>Aktywność</th><th>Schema<br>jest to tytuł posta utrzymujacego dane shemy</th><th>Akcje</th>
    </tr>
    </thead>
    <tbody id="the-list">
<tr class="active">
      <td>Index  </td><td>Aktywny</td> <td>Schema-index</td><td><button class="button">Konfiguruj</button><button class="button">Dezaktywuj</button></td>
    </tr>
    <tr class="active">
      <td>Page</td> <td>Aktywny</td> <td>Schema-content</td><td><button class="button">Konfiguruj</button><button class="button">Dezaktywuj</button></td>
    </tr>
    <tr class="inactive">
      <td>Post</td> <td>Aktywny</td> <td>Schema-content</td><td><button class="button">Konfiguruj</button><br></td>
    </tr>
    <tr class="active">
      <td>Search</td> <td>Aktywny</td> <td>Schema-index</td><td><button class="button">Konfiguruj</button><button class="button">Dezaktywuj</button></td>
    </tr>  
    </tbody>  
  </table>