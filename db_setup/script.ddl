-- ctrl+z
SET GLOBAL FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Turi;
DROP TABLE IF EXISTS Transportavimas;
DROP TABLE IF EXISTS Itrauktas_i;
DROP TABLE IF EXISTS Kiekis;
DROP TABLE IF EXISTS Atsiskaitymas;
DROP TABLE IF EXISTS Naudojamas_daiktas;
DROP TABLE IF EXISTS Tiekejo_produktas;
DROP TABLE IF EXISTS Uzsakymas;
DROP TABLE IF EXISTS Kategorija;
DROP TABLE IF EXISTS Darbuotojas;
DROP TABLE IF EXISTS Busena;
DROP TABLE IF EXISTS Produktas;
DROP TABLE IF EXISTS Klientas;
DROP TABLE IF EXISTS Prisijungimas;
DROP TABLE IF EXISTS Daiktas;
DROP TABLE IF EXISTS Tiekejas;
DROP TABLE IF EXISTS Medziagu_grupe;
DROP TABLE IF EXISTS Ataskaita;
DROP TABLE IF EXISTS Paskyra;

SET GLOBAL FOREIGN_KEY_CHECKS=1;

-- @(#) script.ddl

CREATE TABLE Paskyra
(
	Vardas varchar (255),
	Pavarde varchar (255),
	E_pastas varchar (255),
	Slaptazodis varchar (255),
	Registracijos_data date,
	Paskutinio_prisijungimo_data date,
	Patvirtinta boolean,
	Tipas char (16),
	id integer AUTO_INCREMENT,
	-- CHECK(Tipas in ('KLIENTAS', 'DARBUOTOJAS', 'ADMINISTRATORIUS')),
	PRIMARY KEY(id)
);

CREATE TABLE Ataskaita
(
	Ataskaitos_numeris int AUTO_INCREMENT,
	Nuo_kada date,
	Iki_kada date,
	Sukurimo_data date,
	Tipas char (9),
	PRIMARY KEY(Ataskaitos_numeris)
	-- CHECK(Tipas in ('Trasporto'))
);

CREATE TABLE Medziagu_grupe
(
	Pavadinimas varchar (255),
	id integer AUTO_INCREMENT,
	PRIMARY KEY(id)
);

CREATE TABLE Tiekejas
(
	Vardas varchar (255),
	Firmos_pav varchar (255),
	E_pastas varchar (255),
	Vadybininkas varchar (255),
	Fakturos_Nr int,
	Vadybininko_e_pastas varchar (255),
	Sukurimo_data date,
	id integer AUTO_INCREMENT,
	PRIMARY KEY(id)
);

CREATE TABLE Daiktas
(
	Pavadinimas varchar (255),
	Pridejimo_data date,
	Nurasymo_Data date,
	Verte double,
	id integer AUTO_INCREMENT,
	PRIMARY KEY(id)
);

CREATE TABLE Prisijungimas
(
	Sausainelis varchar (255),
	Pasibaigimo_data date,
	fk_Paskyraid integer,
	PRIMARY KEY(Sausainelis),
	CONSTRAINT Turi FOREIGN KEY(fk_Paskyraid) REFERENCES Paskyra (id)
);

CREATE TABLE Klientas
(
	fk_Paskyra_id integer NOT NULL,
	UNIQUE(fk_Paskyra_id),
	CONSTRAINT Turi_2 FOREIGN KEY(fk_Paskyra_id) REFERENCES Paskyra (id)
);

CREATE TABLE Produktas
(
	Pavadinimas varchar (255),
	Kaina double,
	Sukurimo_data date,
	id integer AUTO_INCREMENT,
	fk_Medziagu_grupeid integer NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT Apibudina FOREIGN KEY(fk_Medziagu_grupeid) REFERENCES Medziagu_grupe (id)
);

CREATE TABLE Busena
(
	Pavadinimas varchar (255),
	id integer AUTO_INCREMENT,
	fk_Daiktasid integer NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT Turi_3 FOREIGN KEY(fk_Daiktasid) REFERENCES Daiktas (id)
);

CREATE TABLE Darbuotojas
(
	Atlyginimas double,
	fk_Paskyraid integer NOT NULL,
	UNIQUE(fk_Paskyraid),
	CONSTRAINT Turi_4 FOREIGN KEY(fk_Paskyraid) REFERENCES Paskyra (id)
);

CREATE TABLE Kategorija
(
	Pavadinimas varchar (255),
	id integer AUTO_INCREMENT,
	fk_Daiktasid integer,
	PRIMARY KEY(id),
	CONSTRAINT Priklauso FOREIGN KEY(fk_Daiktasid) REFERENCES Daiktas (id)
);

CREATE TABLE Uzsakymas
(
	Data date,
	Apmokejima_busena boolean,
	Draudimas boolean,
	Sekimas boolean,
	Pakuotes_ismatavimai char (11),
	Pakuotes_uzpildas char (17),
	id integer AUTO_INCREMENT,
	-- CHECK(Pakuotes_ismatavimai in ('200x200x60', '340x300x60', '400x300x60', '300x220x155', '300x300x100', '400x300x250', '450x340x375')),
	-- CHECK(Pakuotes_uzpildas in ('be_užpido', 'granul?s', 'burbulin?_pl?vel?')),
	PRIMARY KEY(id)
);

CREATE TABLE Tiekejo_produktas
(
	Sukurimo_data date,
	fk_Tiekejasid integer NOT NULL,
	fk_Produktasid integer NOT NULL,
	CONSTRAINT Tiekia FOREIGN KEY(fk_Tiekejasid) REFERENCES Tiekejas (id),
	CONSTRAINT Itraukta_i FOREIGN KEY(fk_Produktasid) REFERENCES Produktas (id)
);

CREATE TABLE Naudojamas_daiktas
(
	Paimtas date,
	Padetas date,
	fk_Daiktasid integer NOT NULL,
	CONSTRAINT Paimtas FOREIGN KEY(fk_Daiktasid) REFERENCES Daiktas (id)
);

CREATE TABLE Atsiskaitymas
(
	Suma double,
	Korteles_nr varchar (255),
	Data date,
	id integer AUTO_INCREMENT,
	fk_Uzsakymasid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Uzsakymasid),
	CONSTRAINT Susijas FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymas (id)
);

CREATE TABLE Kiekis
(
	Kiekis int,
	fk_Uzsakymasid integer NOT NULL,
	CONSTRAINT Turi_tiek FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymas (id)
);

CREATE TABLE Itrauktas_i
(
	fk_AtaskaitaAtaskaitos_numeris int,
	fk_Uzsakymasid integer,
	PRIMARY KEY(fk_AtaskaitaAtaskaitos_numeris, fk_Uzsakymasid),
	CONSTRAINT Itrauktas_i FOREIGN KEY(fk_AtaskaitaAtaskaitos_numeris) REFERENCES Ataskaita (Ataskaitos_numeris)
);

CREATE TABLE Transportavimas
(
	Pristatymo_adresas varchar (255),
	Išsiuntimo_adresas varchar (255),
	Siuntimo_budas char (8),
	id integer AUTO_INCREMENT,
	fk_Uzsakymasid integer NOT NULL,
	-- CHECK(Siuntimo_budas in ('paštu', 'kurjeriu')),
	PRIMARY KEY(id),
	CONSTRAINT turi_priskirta FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymas (id)
);

CREATE TABLE Turi
(
	fk_Produktasid integer,
	PRIMARY KEY(fk_Produktasid),
	CONSTRAINT Tur_5 FOREIGN KEY(fk_Produktasid) REFERENCES Produktas (id)
);
