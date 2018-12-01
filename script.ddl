#@(#) script.ddl

DROP TABLE IF EXISTS Transportavimai;
DROP TABLE IF EXISTS Atsiskaitymai;
DROP TABLE IF EXISTS Naudojami_daiktai;
DROP TABLE IF EXISTS Itraukti_i;
DROP TABLE IF EXISTS Paskyros;
DROP TABLE IF EXISTS Darbuotojai;
DROP TABLE IF EXISTS Klientai;
DROP TABLE IF EXISTS Uzsakymai;
DROP TABLE IF EXISTS Kiekiai;
DROP TABLE IF EXISTS Paskyru_prasymai;
DROP TABLE IF EXISTS Tiekejo_produktai;
DROP TABLE IF EXISTS Daiktai;
DROP TABLE IF EXISTS Produktai;
DROP TABLE IF EXISTS Ataskaitos;
DROP TABLE IF EXISTS Busenos;
DROP TABLE IF EXISTS Kategorijos;
DROP TABLE IF EXISTS Medziagu_grupes;
DROP TABLE IF EXISTS Tiekejai;
DROP TABLE IF EXISTS ataskaitos_tipai;
DROP TABLE IF EXISTS matmenys;
DROP TABLE IF EXISTS siuntimo_budai;
DROP TABLE IF EXISTS uzpildai;
DROP TABLE IF EXISTS vartotoju_roles;
CREATE TABLE vartotoju_roles
(
	id integer,
	name char (21) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO vartotoju_roles(id, name) VALUES(1, 'ROLE_KLIENTAS');
INSERT INTO vartotoju_roles(id, name) VALUES(2, 'ROLE_DARBUOTOJAS');
INSERT INTO vartotoju_roles(id, name) VALUES(3, 'ROLE_ADMINISTRATORIUS');

CREATE TABLE uzpildai
(
	id integer,
	name char (17) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO uzpildai(id, name) VALUES(1, 'be_užpido');
INSERT INTO uzpildai(id, name) VALUES(2, 'granulės');
INSERT INTO uzpildai(id, name) VALUES(3, 'burbulinė_plėvelė');

CREATE TABLE siuntimo_budai
(
	id integer,
	name char (8) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO siuntimo_budai(id, name) VALUES(1, 'paštu');
INSERT INTO siuntimo_budai(id, name) VALUES(2, 'kurjeriu');

CREATE TABLE matmenys
(
	id integer,
	name char (11) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO matmenys(id, name) VALUES(1, '200x200x60');
INSERT INTO matmenys(id, name) VALUES(2, '340x300x60');
INSERT INTO matmenys(id, name) VALUES(3, '400x300x60');
INSERT INTO matmenys(id, name) VALUES(4, '300x220x155');
INSERT INTO matmenys(id, name) VALUES(5, '300x300x100');
INSERT INTO matmenys(id, name) VALUES(6, '400x300x250');
INSERT INTO matmenys(id, name) VALUES(7, '450x340x375');

CREATE TABLE ataskaitos_tipai
(
	id integer,
	name char (9) NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO ataskaitos_tipai(id, name) VALUES(1, 'Trasporto');

CREATE TABLE Tiekejai
(
	Vardas varchar (255),
	Firmos_pav varchar (255),
	E_pastas varchar (255),
	Vadybininkas varchar (255),
	Fakturos_Nr int,
	Vadybininko_e_pastas varchar (255),
	Sukurimo_data date,
	id integer,
	PRIMARY KEY(id)
);

CREATE TABLE Medziagu_grupes
(
	Pavadinimas varchar (255),
	id integer,
	PRIMARY KEY(id)
);

CREATE TABLE Kategorijos
(
	Pavadinimas varchar (255) NOT NULL,
	id integer NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE Busenos
(
	Pavadinimas varchar (255) NOT NULL,
	id integer NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE Ataskaitos
(
	Ataskaitos_numeris int,
	Nuo_kada date,
	Iki_kada date,
	Sukurimo_data date,
	Tipas integer,
	PRIMARY KEY(Ataskaitos_numeris),
	FOREIGN KEY(Tipas) REFERENCES ataskaitos_tipai (id)
);

CREATE TABLE Produktai
(
	Pavadinimas varchar (255),
	Kaina double,
	Sukurimo_data date,
	id integer,
	fk_Medziagu_grupeid integer NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT Apibudina FOREIGN KEY(fk_Medziagu_grupeid) REFERENCES Medziagu_grupes (id)
);

CREATE TABLE Daiktai
(
	Pavadinimas varchar (255) NOT NULL,
	Pridejimo_data date NOT NULL,
	Nurasymo_Data date,
	Verte double NOT NULL,
	id integer NOT NULL,
	fk_Kategorijaid integer,
	fk_Busenaid integer,
	PRIMARY KEY(id),
	CONSTRAINT Priklauso1 FOREIGN KEY(fk_Kategorijaid) REFERENCES Kategorijos (id),
	CONSTRAINT Turi7 FOREIGN KEY(fk_Busenaid) REFERENCES Busenos (id)
);

CREATE TABLE Paskyru_prasymai
(
	Vardas varchar (255) NOT NULL,
	Pavarde varchar (255) NOT NULL,
	E_pastas varchar (255) NOT NULL,
	Slaptazodis varchar (255) NOT NULL,
	Uzpildymo_data date NOT NULL,
	Patvirtinta boolean,
	Tipas integer NOT NULL,
	id integer,
	fk_Darbuotojasid integer,
	PRIMARY KEY(id),
	FOREIGN KEY(Tipas) REFERENCES vartotoju_roles (id),
	CONSTRAINT Patvirtina FOREIGN KEY(fk_Darbuotojasid) REFERENCES Darbuotojai (id)
);

CREATE TABLE Paskyros
(
	Vardas varchar (255) NOT NULL,
	Pavarde varchar (255) NOT NULL,
	E_pastas varchar (255) NOT NULL,
	Slaptazodis varchar (255) NOT NULL,
	Registracijos_data date NOT NULL,
	Paskutinio_prisijungimo_data date,
	Tipas integer NOT NULL,
	id integer NOT NULL,
	fk_Paskyros_prasymasid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Paskyros_prasymasid),
	FOREIGN KEY(Tipas) REFERENCES vartotoju_roles (id),
	CONSTRAINT Turi1 FOREIGN KEY(fk_Paskyros_prasymasid) REFERENCES Paskyru_prasymai (id)
);

CREATE TABLE Klientai
(
	id integer,
	fk_Paskyraid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Paskyraid),
	CONSTRAINT Turi2 FOREIGN KEY(fk_Paskyraid) REFERENCES Paskyros (id)
);

CREATE TABLE Uzsakymai
(
	Data date,
	Apmokejima_busena boolean,
	Draudimas boolean,
	Sekimas boolean,
	Pakuotes_ismatavimai integer,
	Pakuotes_uzpildas integer,
	id integer,
	fk_Klientasid integer NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(Pakuotes_ismatavimai) REFERENCES matmenys (id),
	FOREIGN KEY(Pakuotes_uzpildas) REFERENCES uzpildai (id),
	CONSTRAINT Priklauso2 FOREIGN KEY(fk_Klientasid) REFERENCES Klientai (id)
);

CREATE TABLE Darbuotojai
(
	Atlyginimas double,
	id integer,
	fk_Paskyraid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Paskyraid),
	CONSTRAINT Turi3 FOREIGN KEY(fk_Paskyraid) REFERENCES Paskyros (id)
);

CREATE TABLE Tiekejo_produktai
(
	Sukurimo_data date,
	id integer,
	fk_Produktasid integer NOT NULL,
	fk_Tiekejasid integer NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT Itraukta_i FOREIGN KEY(fk_Produktasid) REFERENCES Produktai (id),
	CONSTRAINT Tiekia FOREIGN KEY(fk_Tiekejasid) REFERENCES Tiekejai (id)
);

CREATE TABLE Itraukti_i
(
	fk_AtaskaitaAtaskaitos_numeris int,
	fk_Uzsakymasid integer,
	PRIMARY KEY(fk_AtaskaitaAtaskaitos_numeris, fk_Uzsakymasid),
	CONSTRAINT Itrauktas_i FOREIGN KEY(fk_AtaskaitaAtaskaitos_numeris) REFERENCES Ataskaitos (Ataskaitos_numeris)
);

CREATE TABLE Naudojami_daiktai
(
	Paimtas date NOT NULL,
	Padetas date,
	id integer,
	fk_Darbuotojasid integer NOT NULL,
	fk_Daiktasid integer NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT Naudoja FOREIGN KEY(fk_Darbuotojasid) REFERENCES Darbuotojai (id),
	CONSTRAINT Paimtas FOREIGN KEY(fk_Daiktasid) REFERENCES Daiktai (id)
);

CREATE TABLE Atsiskaitymai
(
	Suma double,
	Korteles_nr varchar (255),
	Data date,
	id integer,
	fk_Uzsakymasid integer NOT NULL,
	fk_Klientasid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Uzsakymasid),
	UNIQUE(fk_Klientasid),
	CONSTRAINT Susijas FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymai (id),
	CONSTRAINT Turi_buti_apmoketas FOREIGN KEY(fk_Klientasid) REFERENCES Klientai (id)
);

CREATE TABLE Transportavimai
(
	Pristatymo_adresas varchar (255),
	Issiuntimo_adresas varchar (255),
	Siuntimo_budas integer,
	id integer,
	fk_Uzsakymasid integer NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(Siuntimo_budas) REFERENCES siuntimo_budai (id),
	CONSTRAINT turi_priskirta FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymai (id)
);

CREATE TABLE Kiekiai
(
	Kiekis int,
	id integer,
	fk_Uzsakymasid integer NOT NULL,
	fk_Uzsakymasid1 integer NOT NULL,
	fk_Produktasid integer NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Uzsakymasid1),
	CONSTRAINT Turi_tiek FOREIGN KEY(fk_Uzsakymasid) REFERENCES Uzsakymai (id),
	FOREIGN KEY(fk_Uzsakymasid1) REFERENCES Uzsakymai (id),
	CONSTRAINT Turi6 FOREIGN KEY(fk_Produktasid) REFERENCES Produktai (id)
);
