## Opis projektu
Ten projekt został stworzony jako projekt szkolny w klasie 2 technikum. Jest to strona internetowa napisana w PHP, która zawiera różne funkcjonalności, takie jak:

- System komentarzy
- Galeria zdjęć
- Panel użytkownika
- Licznik odwiedzin
- Formularz zamówień
- generator kodów kreskowych i pdfa z potwierdzeniem


## Wymagania
- Serwer obsługujący PHP (np. XAMPP, WAMP, LAMP).
- Baza danych MySQL.
- W pliku `php.ini` należy włączyć następujące ustawienia:
  - `extension=mysqli` (odkomentować linię `extension=mysqli` usuwając średnik na początku).
  - `extension=gd` (odkomentować linię `extension=gd` usuwając średnik na początku).
  - `extension=mbstring` (odkomentować linię `extension=mbstring` usuwając średnik na początku).


Instalacja
1. Sklonuj repozytorium na swój lokalny komputer.
2. Zaimportuj plik `obozy.sql` do swojej bazy danych MySQL.
3. Skonfiguruj połączenie z bazą danych w plikach PHP (np. `czat.php`, `zamowienia.php`).
4. Uruchom serwer lokalny i otwórz stronę w przeglądarce.

Projekt opracował: Jan Rampalski