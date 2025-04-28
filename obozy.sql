-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 21, 2024 at 11:50 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obozy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `idw` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`idw`, `idu`, `message`, `date`) VALUES
(9, 4, 'Dzięki obozowi zimowemu nasza córka pokonała swoje lęki związane ze stokiem i teraz jeździ na nartach jak prawdziwa profesjonalistka! Jestem pod wrażeniem!', '2024-05-04'),
(10, 5, 'Nigdy wcześniej nie widziałam tak dobrze zorganizowanego obozu zimowego dla dzieci. Bezpieczeństwo i zabawa na najwyższym poziomie!', '2024-05-03'),
(11, 6, 'Nasza pociecha spędziła tu niesamowite ferie! Super instruktorzy, świetne warunki i wiele ciekawych zajęć. Polecamy!', '2024-05-02'),
(12, 7, 'Świetna opcja dla dzieci, które uwielbiają zimę i sporty śnieżne! Nasz synek wrócił pełen entuzjazmu i chce już teraz wracać!', '2024-05-01'),
(13, 8, 'Fantastyczne miejsce na zimowy wypoczynek dla dzieci! Bezpieczeństwo, doświadczeni instruktorzy i mnóstwo śnieżnej zabawy!', '2024-04-30'),
(14, 9, 'Nasza córka była zachwycona tym obozem! Z dnia na dzień rozwijała swoje umiejętności narciarskie i miała mnóstwo frajdy!', '2024-04-29'),
(15, 10, 'Dziękujemy za niesamowite wspomnienia! Nasz syn wrócił z obozu pełen nowych doświadczeń i przyjaciół.', '2024-04-28'),
(17, 12, 'Bardzo nam się podobało! Nasze dziecko wróciło szczęśliwe, zmęczone i pełne wrażeń. Polecamy wszystkim rodzicom!', '2024-04-26'),
(18, 13, 'Świetny sposób na aktywne spędzenie zimowych ferii! Nasza córka uwielbiała każdą chwilę na tym obozie!', '2024-04-25'),
(19, 14, 'Dziękujemy za wspaniałe wakacje! Nasz syn wrócił pełen radości i entuzjazmu do nauki jazdy na nartach.', '2024-04-24'),
(20, 15, 'To był strzał w dziesiątkę! Nasze dziecko spędziło tu niesamowite chwile, pełne śmiechu i przygód. Gorąco polecamy!', '2024-04-23'),
(61, 18, 'Super zabawa!', '2024-05-08'),
(68, 3, 'Nasza córka uwielbiała ten obóz! Codziennie nowe atrakcje, świetna atmosfera i wiele możliwości do aktywnego spędzania czasu.', '2023-11-24'),
(69, 4, 'Bardzo zadowoleni z tego obozu! Profesjonalna opieka, bezpieczeństwo i mnóstwo zabawy dla dzieci nad brzegiem morza.', '2024-05-01'),
(70, 5, 'Nasz syn wrócił z obozu pełen wrażeń! Plaża, słońce i mnóstwo aktywności - to było dokładnie to, czego potrzebował na udane wakacje!', '2024-05-08'),
(71, 6, 'Świetna opcja dla dzieci, które uwielbiają morze i plażowanie! Nasza córka wróciła pełna opowieści o surfowaniu i budowaniu zamków z piasku!', '2024-04-03'),
(72, 7, 'Fantastyczne miejsce na letni wypoczynek dla dzieci! Nasz syn wrócił pełen entuzjazmu i wspomnień na całe życie!', '2024-04-24'),
(73, 8, 'Dziękujemy za wspaniałe wakacje! Nasza córka wróciła z obozu pełna radości i nowych umiejętności w sporcie wodnym.', '2024-05-20'),
(74, 9, 'To był strzał w dziesiątkę! Nasze dziecko spędziło tu cudowne chwile, pełne słonecznych dni i przygód. Polecamy wszystkim rodzicom!', '2024-03-15'),
(75, 10, 'Nasze dziecko wróciło z obozu nad morzem zachwycone! Super atmosfera, świetne zajęcia i wiele ciekawych atrakcji. Gorąco polecamy!', '2024-04-04'),
(77, 12, 'Bardzo nam się podobało! Nasza córka wróciła z obozu pełna wrażeń i nowych znajomości. Polecamy wszystkim rodzicom!', '2024-04-26'),
(78, 13, 'To był niezapomniany tydzień pełen aktywności i przygód! Nasze dziecko wróciło pełne uśmiechu i wspomnień na całe życie.', '2024-05-04'),
(79, 14, 'Dzięki obozowi nad morzem nasza pociecha spędziła wspaniałe wakacje! Profesjonalna kadra, bezpieczeństwo i mnóstwo atrakcji', '2024-05-21'),
(80, 15, 'Nasza córka była zachwycona tym obozem! Codziennie nowe wyzwania i emocjonujące zajęcia. Gorąco polecamy wszystkim rodzicom!', '2024-05-10'),
(81, 16, 'Nasz syn wrócił z obozu nad morzem pełen nowych umiejętności i przyjaciół! To był dla niego niezapomniany tydzień wspaniałej zabawy i nauki.', '2024-05-15'),
(82, 17, 'Fantastyczne miejsce na letni wypoczynek! Nasza córka uwielbiała codzienne kąpiele w morzu i wieczorne ogniska na plaży.', '2024-05-13'),
(83, 18, 'Dzięki obozowi nad morzem nasze dziecko miało możliwość rozwijania swoich pasji i zainteresowań w przyjaznej atmosferze. Jesteśmy bardzo zadowoleni z tych wakacji', '2024-04-10'),
(95, 27, 'Jako rodzic, byłem ogromnie zadowolony widząc, jak moje dziecko wraca z obozu zimowego pełne entuzjazmu i uśmiechu. Dzięki różnorodnym aktywnościom na świeżym powietrzu, takim jak narciarstwo, sanki, czy zimowe zabawy, moje dziecko miało szansę na aktywny wypoczynek i rozwój fizyczny.', '2024-05-10'),
(97, 27, 'Podczas ostatniego pobytu moje dziecko przeżyło niepowtarzalną przygodę, która zaskoczyła nas wszystkich swoim bogactwem i różnorodnością.\r\n', '2024-05-10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `user` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_url`, `user`, `date`) VALUES
(9, 'uploads/IMG-663e0f58595d20.68241074.jpeg', 'natek', '2024-05-10'),
(10, 'uploads/IMG-663e100d506a70.61792273.jpg', 'szlugaj', '2024-05-10'),
(11, 'uploads/IMG-663e1017b98901.66516442.jpeg', 'blackie', '2024-05-10'),
(12, 'uploads/IMG-663e1021525750.26035855.jpeg', 'rudy', '2024-05-10'),
(24, 'uploads/IMG-664bb9d05a29d6.20749310.jpeg', 'admin', '2024-05-20'),
(25, 'uploads/IMG-664bba39473202.15354339.jpeg', 'kaczka', '2024-05-20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oferta`
--

CREATE TABLE `oferta` (
  `id` int(11) NOT NULL,
  `miejscowosc` text NOT NULL,
  `opis` text NOT NULL,
  `miejsca_actual` int(11) DEFAULT NULL,
  `miejsca_max` int(11) DEFAULT NULL,
  `cena` int(11) DEFAULT NULL,
  `il_dni` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oferta`
--

INSERT INTO `oferta` (`id`, `miejscowosc`, `opis`, `miejsca_actual`, `miejsca_max`, `cena`, `il_dni`) VALUES
(1, 'Karpacz', 'Nauka jazdy na nartach lub snowboardzie pod okiem profesjonalnych instruktorów. Gry i zabawy integracyjne dla dzieci, mające na celu budowanie relacji i współpracę.', 0, 10, 500, 5),
(2, 'Wisła', 'Zabawy na śniegu, takie jak zjeżdżanie na sankach, budowanie igloo lub bałwanów. Organizacja konkursów i zabaw terenowych na śniegu.', 0, 20, 300, 7),
(3, 'Zakopane', 'Wyjścia na wycieczki po okolicy, np. na spacery po lesie czy wizyty w pobliskich atrakcjach. Warsztaty twórcze, np. rzeźbienie w lodzie, malowanie na śniegu czy nauka pierwszej pomocy w warunkach zimowych.', 0, 25, 700, 4),
(4, 'Solina', 'Wieczorne ogniska z pieczeniem kiełbasek i opowieściami przy dźwiękach trzaskającego ognia. Wieczorne animacje i dyskoteki dla dzieci, aby zakończyć dzień w radosnej atmosferze.', 0, 15, 200, 3),
(5, 'Krynica-Zdrój', 'Możliwość korzystania z infrastruktury ośrodka, takiej jak basen, sauna czy sala do gier. Spotkania ze zwierzętami, np. kuligi z zaprzęgiem konnym lub wizyty w mini-zoo.', 0, 23, 100, 2),
(6, 'Sopot', 'Nauka surfingu i windsurfingu pod okiem doświadczonych instruktorów. Zajęcia z żeglarstwa, w tym nauka obsługi żagla i sterowania łodzią.', 0, 15, 1200, 6),
(7, 'Kołobrzeg', 'Plażowe turnieje sportowe, takie jak piłka plażowa, siatkówka czy frisbee. Wycieczki po okolicznych atrakcjach, np. do latarni morskiej, muzeum morskiego czy rezerwatu przyrody.', 0, 20, 400, 3),
(8, 'Władysławowo', 'Zajęcia kreatywne, np. rzeźbienie w piasku, malowanie na plaży czy tworzenie biżuterii z muszelek. Wyprawy rowerowe po nadmorskich ścieżkach rowerowych.', 0, 15, 450, 2),
(9, 'Świnoujście', 'Zajęcia survivalowe na plaży, np. nauka budowy schronienia, poszukiwanie jadalnych roślin czy rozpalanie ogniska. Warsztaty kulinarne, gdzie dzieci mogą uczyć się przygotowywania potraw z owoców morza i lokalnych produktów.', 0, 30, 200, 2),
(10, 'Łeba', 'Wieczorne spacery po plaży z poszukiwaniem skarbów i opowieściami o piratach. Możliwość korzystania z atrakcji wodnych, takich jak wynajem kajaków, skuterów wodnych czy rejsy statkiem w okoliczne miejsca.', 0, 25, 400, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'admin', 'zaq1@WSX', 'admin@mail.com'),
(2, 'Stanisław', 'zaq1@WSX', 'stas@cos.pl'),
(3, 'adsdsasadsaasd', 'zaq1@WSX', 'bruh@gmail.com'),
(4, 'login', 'zaq1@WSX', 'login@gmail.com'),
(5, 'loginek', 'zaq1@WSX', 'test@mail.com'),
(6, 'natek', 'zaq1@WSX', 'natzbik@gmail.com'),
(7, 'kaczka', 'zaq1@WSX', 'kaczka@gmail.com'),
(8, 'szlugaj', 'zaq1@WSX', 'szlugaj@gmail.com'),
(9, 'jakiś user', 'zaq1@WSX', 'user@gmail.com'),
(10, 'blackie', 'zaq1@WSX', 'blackie@gmail.com'),
(11, 'emosczarny', 'zaq1@WSX', 'emology@gmail.com'),
(12, 'emosfioletowy', 'zaq1@WSX', 'emos@gmail.com'),
(13, 'furas', 'zaq1@WSX', 'furas@gmail.com'),
(14, 'grand_lord', 'zaq1@WSX', 'lord@gmail.com'),
(15, 'nerd', 'zaq1@WSX', 'nerdowski@gmail.com'),
(16, 'new_user', 'zaq1@WSX', 'email@gmail.com'),
(23, 'testing', 'zaq1@WSX', 'abc@domena.org'),
(24, 'testow_login', 'zaq1@WSX', 'abc@domena.org'),
(25, 'ktoś', 'zaq1@WSX', 'ktos@gmail.com'),
(26, 'administracja', 'zaq1@WSX', 'administracja@mail.com'),
(32, 'rudy', 'zaq1@WSX', 'rudy@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_usera` int(11) DEFAULT NULL,
  `id_oferty` int(11) DEFAULT NULL,
  `imie_d` text DEFAULT NULL,
  `nazwisko_d` text DEFAULT NULL,
  `imie_r` text DEFAULT NULL,
  `nazwisko_r` text DEFAULT NULL,
  `tel` char(20) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `selected_age` text DEFAULT NULL,
  `liczba_max` int(11) DEFAULT NULL,
  `barcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `id_usera`, `id_oferty`, `imie_d`, `nazwisko_d`, `imie_r`, `nazwisko_r`, `tel`, `city`, `selected_age`, `liczba_max`, `barcode`) VALUES
(92, 15, 3, 'Jan', 'Kowalski', 'Anna', 'Nowak', '511589314', 'Warszawa', '5 - 7 lat', 25, '*81234567*'),
(93, 10, 7, 'Maria', 'Nowak', 'Piotr', 'Wiśniewski', '522278946', 'Kraków', '8 - 10 lat', 20, '*92345678*'),
(94, 8, 6, 'Andrzej', 'Wiśniewski', 'Małgorzata', 'Kowalczyk', '533632155', 'Gdańsk', '11 - 13 lat', 30, '*34567891*'),
(95, 4, 1, 'Katarzyna', 'Dąbrowska', 'Tomasz', 'Lewandowski', '544548921', 'Łódź', '14 - 16 lat', 15, '*45678912*'),
(96, 2, 9, 'Paweł', 'Lewandowski', 'Magdalena', 'Woźniak', '555359712', 'Wrocław', '5 - 7 lat', 20, '*53698741*'),
(97, 7, 8, 'Ewa', 'Kamińska', 'Krzysztof', 'Szymański', '566698214', 'Poznań', '8 - 10 lat', 20, '*69874123*'),
(98, 6, 2, 'Michał', 'Kowalczyk', 'Barbara', 'Dąbrowska', '577325874', 'Szczecin', '11 - 13 lat', 15, '*70123456*'),
(99, 11, 4, 'Anna', 'Jankowska', 'Tadeusz', 'Mazur', '588512369', 'Bydgoszcz', '14 - 16 lat', 15, '*91234567*'),
(100, 14, 5, 'Wojciech', 'Wojciechowska', 'Monika', 'Kwiatkowska', '599653214', 'Katowice', '5 - 7 lat', 23, '*03456789*'),
(101, 9, 10, 'Magdalena', 'Krawczyk', 'Marcin', 'Kaczmarek', '500325487', 'Gdynia', '8 - 10 lat', 25, '*12345678*'),
(102, 12, 3, 'Krzysztof', 'Grabowska', 'Kinga', 'Piotrowski', '511458962', 'Sosnowiec', '11 - 13 lat', 25, '*24567891*'),
(103, 3, 6, 'Patrycja', 'Pawlak', 'Paweł', 'Grabowski', '522698742', 'Radom', '14 - 16 lat', 15, '*33698741*'),
(104, 16, 9, 'Damian', 'Michalski', 'Marta', 'Zając', '533352014', 'Kielce', '5 - 7 lat', 10, '*44768123*'),
(106, 5, 1, 'Karolina', 'Walczak', 'Justyna', 'Sikorski', '555412365', 'Bielsko-Biała', '11 - 13 lat', 23, '*55812345*'),
(107, 13, 8, 'Tomasz', 'Szymczak', 'Mariusz', 'Ostrowski', '566698745', 'Gorzów Wielkopolski', '14 - 16 lat', 15, '*66987451*'),
(108, 8, 5, 'Natalia', 'Jabłoński', 'Weronika', 'Jasiński', '577598741', 'Tychy', '5 - 7 lat', 25, '*77012345*'),
(109, 3, 9, 'Robert', 'Kowal', 'Dawid', 'Bąk', '588965214', 'Opole', '8 - 10 lat', 20, '*89123456*'),
(110, 11, 7, 'Dominika', 'Majewska', 'Kamil', 'Sawicki', '599325874', 'Elbląg', '11 - 13 lat', 23, '*00345678*'),
(111, 10, 4, 'Monika', 'Urbański', 'Dominik', 'Leszczyński', '500412365', 'Wałbrzych', '14 - 16 lat', 15, '*11456789*'),
(112, 7, 10, 'Łukasz', 'Pająk', 'Aneta', 'Chmielewska', '511325874', 'Przemyśl', '5 - 7 lat', 15, '*22345678*'),
(113, 14, 6, 'Sylwia', 'Duda', 'Mikołaj', 'Górecki', '522412365', 'Legnica', '8 - 10 lat', 30, '*33456789*'),
(114, 6, 3, 'Paulina', 'Sobczak', 'Aleksander', 'Sikora', '533325874', 'Olsztyn', '11 - 13 lat', 25, '*44567891*'),
(115, 9, 8, 'Bartosz', 'Kaczmarczyk', 'Kacper', 'Kubiak', '544965214', 'Zielona Góra', '14 - 16 lat', 25, '*55678912*'),
(116, 5, 5, 'Martyna', 'Górski', 'Karol', 'Olejnik', '555325874', 'Płock', '5 - 7 lat', 15, '*66789123*'),
(117, 12, 1, 'Klaudia', 'Wójtowicz', 'Julia', 'Żukowski', '566965214', 'Jastrzębie-Zdrój', '8 - 10 lat', 23, '*77901234*'),
(121, 13, 10, 'Sebastian', 'Witkowski', 'Nikola', 'Czarnecki', '500965214', 'Kędzierzyn-Koźle', '8 - 10 lat', 15, '*1234567*');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idw`);

--
-- Indeksy dla tabeli `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `idw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
