<h2>UiGEN - Struktury danych </h2>(na razie po polsku)

<p>Struktury danych w pluginie uigen oparte są o natywne elementy wordpressa stworzone do tego celu.
UiGEN jedynie rozszerza te struktóry o kilka mechanizmów, które opiszę w poniższym dokumencie.</p>

<h3>Standardowe struktury danych wordpressa:</h3>

<h4>Post oraz typ postu.</h4>

<p>Jest to szeregowa struktura danych utrzymujących obiekty będące wpisami w wordpressie. Obiekty te posiadają parametry takie jak: tytuł, kontent, zajawkę, datę utworzernia autora itd.
szczegółowy opis zawartości obiektu typu wpis znajdziemy w dokumentacji wordpressa pod adresem:	<a href"http://codex.wordpress.org/Function_Reference/get_post">http://codex.wordpress.org/Function_Reference/get_post</a>.
Dodatkowo poza parametrami podstawowymi obiekt typu post może posiadać parametry dodatkowe nazwane w wordpressie matadanymi. Metadanych moze być nieskończenie wiele i mogą one przechowywać dowolne dane.</a>

<p>Jedną z funkcionalności UiGENa jest możliwość wprowadzania do metadanych danych zapisanych w formacie JSON. Do tego celu wykorzystywana jest zewnętrzna biblioteka Alpacajs.</p>