create TABLE Language
(
    id       int NOT NULL,
    PRIMARY KEY (id),
    language varchar(100),
    icon     varchar(50)
) ENGINE = InnoDB;

create TABLE RatedCategory
(
    id          int NOT NULL,
    PRIMARY KEY (id),
    orderNumber int NOT NULL
) ENGINE = InnoDB;

create TABLE RatedCategoryTranslate
(
    idRatedCategory int          NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory (id),
    idLanguage      int          NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    nameCategory    varchar(250) NOT NULL
) ENGINE = InnoDB;

create TABLE Menu
(
    id int NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

create TABLE MenuTranslate
(
    idMenu     int  NOT NULL,
    FOREIGN KEY (idMenu) REFERENCES Menu (id),
    idLanguage int  NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name       text NOT NULL
) ENGINE = InnoDB;

create TABLE Destination
(
    id             int NOT NULL,
    PRIMARY KEY (id),
    image1         varchar(100),
    image2         varchar(100),
    version        bigint    DEFAULT 0,
    image1Version  bigint    DEFAULT -1,
    image2Version  bigint    DEFAULT -1,
    isOkForShowing binary(1) DEFAULT 0,
    showIt         binary(1) DEFAULT 1,
    mappingString  varchar(100)
) ENGINE = InnoDB;

create TABLE DestinationTranslate
(
    idLanguage    int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination (id),
    name          varchar(150),
    description   text
) ENGINE = InnoDB;

create TABLE CategoryVendor
(
    id int NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

create TABLE CategoryVendorTranslate
(
    idCategoryVendor int NOT NULL,
    FOREIGN KEY (idCategoryVendor) REFERENCES CategoryVendor (id),
    idLanguage       int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name             varchar(150)
) ENGINE = InnoDB;

create TABLE PaymentInfoActivity
(
    id      int NOT NULL,
    version bigint DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE = InnoDB;

create TABLE PaymentInfoActivityTranslate
(
    idPaymentInfoActivity int NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity (id),
    idLanguage            int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    head                  double(10, 2),
    description           text
) ENGINE = InnoDB;

create TABLE Vendor
(
    id                     int   NOT NULL,
    PRIMARY KEY (id),
    version                bigint         DEFAULT 0,
    isOkForShowing         binary(1)      DEFAULT 0,
    idDestination          int   NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination (id),
    priceAdult             float NOT NULL,
    originalPrice          float NOT NULL,
    discount               float NOT NULL,
    priceKid               float NOT NULL,
    imageBasic             varchar(100),
    imageBasicVersion      bigint         DEFAULT -1,
    idCategory             int   NOT NULL,
    FOREIGN KEY (idCategory) REFERENCES CategoryVendor (id),
    idPaymentInfoActivity  int   NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity (id),
    googleMapsImage        varchar(100),
    googleMapsImageVersion bigint         DEFAULT -1,
    infantPrice            int,
    forHowManyPersonsIs    int,
    childAcceptance        int   NOT NULL DEFAULT 1,
    infantTolerance        int   NOT NULL DEFAULT 1,
    isActiveNow            binary(1)      DEFAULT 1,
    hourCancel             int            DEFAULT 24,
    minAgeAdult            int            DEFAULT 13,
    minAgeKid              int            DEFAULT 4,
    priceKidVendor         float NOT NULL
) ENGINE = InnoDB;

create TABLE VendorTranslate
(
    idVendor        int          NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE,
    idLanguage      int          NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name            varchar(100) NOT NULL,
    descriptionBig  text         NOT NULL,
    descriptionFull text         NOT NULL
) ENGINE = InnoDB;

create TABLE BestOff
(
    id            int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination (id),
    idVendor      int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE
) ENGINE = InnoDB;

create TABLE LabelsBox
(
    id      int NOT NULL,
    PRIMARY KEY (id),
    version bigint DEFAULT 0
) ENGINE = InnoDB;
create TABLE LabelsBoxTranslate
(
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox (id),
    idLanguage  int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name        varchar(100)
) ENGINE = InnoDB;

create TABLE VendorLabelsBox
(
    id          int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor    int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE,
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox (id)
) ENGINE = InnoDB;

create TABLE VendorImages
(
    id       int,
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE,
    image    varchar(100)
) ENGINE = InnoDB;

create TABLE Highlight
(
    id       int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE
) ENGINE = InnoDB;

create TABLE HighlightTranslate
(
    idHighlight int NOT NULL,
    FOREIGN KEY (idHighlight)
        REFERENCES Highlight (id)
        ON delete CASCADE,
    idLanguage  int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name        text
) ENGINE = InnoDB;

create TABLE Rated
(
    idRatedCategory int NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory (id),
    idVendor        int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE,
    stars           int NOT NULL
) ENGINE = InnoDB;

create TABLE IncludedService
(
    id      int NOT NULL,
    PRIMARY KEY (id),
    icon    varchar(100),
    version bigint DEFAULT 0
) ENGINE = InnoDB;
create TABLE IncludedServiceTranslate
(
    idIncludedService int  NOT NULL,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService (id),
    idLanguage        int  NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name              text NOT NULL
) ENGINE = InnoDB;

create TABLE VendorIncludedService
(
    id                int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idVendor          int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE,
    idIncludedService int not null,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService (id)
) ENGINE = InnoDB;
create TABLE AboutActivity
(
    id       int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE
) ENGINE = InnoDB;
create TABLE AboutActivityTranslate
(
    idAboutActivity int NOT NULL,
    FOREIGN KEY (idAboutActivity)
        REFERENCES AboutActivity (id)
        ON delete CASCADE,
    idLanguage      int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    head            text,
    description     text
) ENGINE = InnoDB;

create TABLE ImportantInformationHead
(
    id       int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id) ON DELETE CASCADE
) ENGINE = InnoDB;
create TABLE ImportantInformationDescription
(
    id                         int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idImportantInformationHead int NOT NULL,
    FOREIGN KEY (idImportantInformationHead)
        REFERENCES ImportantInformationHead (id)
        ON delete CASCADE
) ENGINE = InnoDB;
create TABLE ImportantInformationHeadTranslate
(
    idImportantInformationHead int NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (idImportantInformationHead)
        REFERENCES ImportantInformationHead (id)
        ON delete CASCADE,
    idLanguage                 int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name                       text
) ENGINE = InnoDB;
create TABLE ImportantInformationDescriptionTranslate
(
    idImportantInformationDescription int NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (idImportantInformationDescription)
        REFERENCES ImportantInformationDescription (id)
        ON delete CASCADE,
    idLanguage                        int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language (id),
    name                              text
) ENGINE = InnoDB;

create TABLE VendorVoucher
(
    id               int       NOT NULL,
    PRIMARY KEY (id),
    idVendor         int       NOT NULL,
    isDateRestrict   binary(1) NOT NULL,
    starterVouchers  int       NOT NULL,
    existenceVoucher int       NOT NULL,
    dateVoucher      datetime  NOT NULL
) ENGINE = InnoDB;

create TABLE Version
(
    id      int    NOT NULL,
    PRIMARY KEY (id),
    version bigint NOT NULL DEFAULT 0,
    name    varchar(256)
) ENGINE = InnoDB;


insert into `Language` (`id`, `language`, `icon`)
VALUES (1, 'Ελληνικά', 'gr'),
       (2, 'English', 'gb');



insert into `PaymentInfoActivity` (id)
VALUES (1),
       (2);

insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`,
                                            `idLanguage`, `head`, `description`)
values (1, 1, 2.1,
        'Αγοράστε τώρα ένα κουπόνι VP για την κράτηση της δραστηριότητάς σας και πληρώστε αργότερα για τη δραστηριότητά
        σας με έκπτωση όταν φτάσετε. Ελέγξτε το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.');
insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`,
                                            `idLanguage`, `head`, `description`)
values (1, 2, 2.1,
        'Buy a VP voucher for your activity reservation now and pay later for your activity with a discount when
         you arrive. Check your activity voucher once you have booked for full details.');

insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`,
                                            `idLanguage`, `head`, `description`)
values (2, 1, 1.1,
        'Αγοράστε το VP Voucher εν πλω, κρατήστε τη θέση σας και πληρώστε τον πάροχο με έκπτωση όταν φτάσετε στην
        τοποθεσία της δραστηριότητας. Ελέγξτε το email επιβεβαίωσης, για τις απαραίτητες πληροφορίες.');
insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`,
                                            `idLanguage`, `head`, `description`)
values (2, 2, 1.1,
        'Purchase your VP Voucher on board, reserve your spot, and pay the provider with a
        discount when you arrive at your activity location. Check your confirmation email once you book for full details.');

insert into RatedCategory(id, orderNumber)
values (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (5, 5),
       (6, 6),
       (7, 7);
insert into RatedCategoryTranslate(idRatedCategory, idLanguage, nameCategory)
values (1, 1, 'Ποιότητα Εξυπηρέτησης Πελατών'),
       (1, 2, 'Customer Service Quality'),
       (2, 1, 'Εξατομίκευση & Ευελιξία'),
       (2, 2, 'Personalization & Flexibility'),
       (3, 1,
        'Πρότυπα ασφάλειας και υγιεινής (συμπεριλαμβανομένου του Covid-19)'),
       (3, 2, 'Safety & Sanitary Standards (Covid-19 Included)'),
       (4, 1, 'Ποιότητα Υλικών'),
       (4, 2, 'Quality of Materials'),
       (5, 1, 'Ηθικές Εργασιακές Πρακτικές'),
       (5, 2, 'Ethical Labor Practices'),
       (6, 1, 'Περιβαλλοντική Ευθύνη'),
       (6, 2, 'Environmental Responsibility'),
       (7, 1, 'Σεβασμός στους Πολιτιστική Κληρονομιά'),
       (7, 2, 'Respect for Local Cultures');

insert into Version(id, name)
values (1, 'general'),
       (2, 'ratedCategory'),
       (3, 'menu'),
       (4, 'destination'),
       (5, 'categoryVendor'),
       (6, 'paymentInfoActivity'),
       (7, 'vendor'),
       (8, 'labelsBox'),
       (9, 'includedService'),
       (10, 'language');

/*
DROP TABLE VendorVoucher;
DROP TABLE ImportantInformationDescriptionTranslate;
DROP TABLE ImportantInformationHeadTranslate;
DROP TABLE ImportantInformationDescription;
DROP TABLE ImportantInformationHead;
DROP TABLE AboutActivityTranslate;
DROP TABLE AboutActivity;
DROP TABLE VendorIncludedService;
DROP TABLE Rated;
DROP TABLE HighlightTranslate;
DROP TABLE Highlight;
DROP TABLE VendorImages;
DROP TABLE VendorLabelsBox;
DROP TABLE BestOff;
DROP TABLE VendorTranslate;
DROP TABLE Vendor;
DROP TABLE DestinationTranslate;
DROP TABLE Destination;
DROP TABLE CategoryVendorTranslate;
DROP TABLE CategoryVendor;
DROP TABLE IncludedServiceTranslate;
DROP TABLE IncludedService;
DROP TABLE LabelsBoxTranslate;
DROP TABLE LabelsBox;
DROP TABLE MenuTranslate;
DROP TABLE Menu;
DROP TABLE PaymentInfoActivityTranslate;
DROP TABLE PaymentInfoActivity;
DROP TABLE RatedCategoryTranslate;
DROP TABLE RatedCategory;
DROP TABLE Version;
DROP TABLE Language;
 */

