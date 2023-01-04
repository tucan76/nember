create table dbo.PROCEDURY (
    id int not null,
    nazev nvarchar(50) not null,
    kod nchar(10) not null,
    hodnota numeric(18,0) null,
    plati_od date null,
    plati_do date null,
    primary key (id ASC)
);

insert dbo.PROCEDURY(id,nazev,kod, hodnota,plati_od, plati_do) values (1, N'Test     ', N'22        ', CAST(222 AS Numeric(18, 0)), CAST(N'2022-12-01' AS Date), CAST(N'2021-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (2, N'Bazén skupinový - DKK', N'bsdkk     ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (3, N'Bazén skupinovy - záda', N'bsz       ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (4, N'Bazén skupinovy - záda + neuro', N'bszn      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (5, N'Běžecký pás / Stepper - zdarma', N'bpsz      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (6, N'Celotělová vířivka', N'ctv      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (7, N'David - individál série 10+2', N'ds102      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (8, N'David - kruhový trénink', N'dkt      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (9, N'David - kruhový trénink série', N'dkts      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (10, N'Camopede', N'cmpd      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (11, N'Cykla', N'cykla      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));
INSERT dbo.PROCEDURY (id, nazev, kod, hodnota, plati_od, plati_do) VALUES (12, N'Cryo jet', N'crjt      ', NULL, CAST(N'2022-12-01' AS Date), CAST(N'2023-12-01' AS Date));

CREATE TABLE dbo.PROCEDURY_UZIVATELE(
	uzivatel_id int NOT NULL,
	procedura_id int NOT NULL,
    primary key (
	uzivatel_id ASC,
	procedura_id ASC
    )
);

INSERT dbo.PROCEDURY_UZIVATELE (uzivatel_id, procedura_id) VALUES (1, 3);
INSERT dbo.PROCEDURY_UZIVATELE (uzivatel_id, procedura_id) VALUES (2, 1);

CREATE TABLE dbo.UZIVATELE(
	id int NOT NULL,
	jmeno nvarchar(50) NOT NULL,
	prijmeni nvarchar(50) NOT NULL,
    primary key (id ASC)
);

INSERT dbo.UZIVATELE (id, jmeno, prijmeni) VALUES (1, N'Michal', N'Bernat');
INSERT dbo.UZIVATELE (id, jmeno, prijmeni) VALUES (2, N'Antonín', N'Novotný');


