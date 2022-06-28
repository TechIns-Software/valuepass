-- TODO: add Default values
-- TODO: Web and Nikos change tables of date types
-- id of to be started from 1
CREATE TABLE Language (
    id int NOT NULL,
    PRIMARY KEY (id),
    language varchar(100),
    icon varchar(50)
)ENGINE=InnoDB;
CREATE TABLE Destination (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    image1 varchar (100),
    image2 varchar (100)
)ENGINE=InnoDB;
CREATE TABLE DestinationTranslate (
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    name varchar (100),
    description text
)ENGINE=InnoDB;
CREATE TABLE CategoryVendor (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
)ENGINE=InnoDB;
CREATE TABLE CategoryVendorTranslate (
    idCategoryVendor int NOT NULL,
    FOREIGN KEY (idCategoryVendor) REFERENCES CategoryVendor(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100)
)ENGINE=InnoDB;
CREATE TABLE PaymentInfoActivity (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
)ENGINE=InnoDB;
CREATE TABLE PaymentInfoActivityTranslate (
    idPaymentInfoActivity int NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    head double(10,2),
    description text

)ENGINE=InnoDB;
CREATE TABLE Vendor (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    priceAdult float NOT NULL,
    originalPrice float NOT NULL,
    discount float NOT NULL,
    priceKid float NOT NULL,
    imageBasic varchar(100),
    idCategory int NOT NULL,
    FOREIGN KEY (idCategory) REFERENCES CategoryVendor(id),
    idPaymentInfoActivity int NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity(id),
    isCompleted binary(1) DEFAULT 0,
    googleMapsString varchar(200) NOT NULL,
    voucherMessage1 text,
    voucherMessage2 text,
    infantPrice int
    -- number,email,website,IBAN, personal message to them who take voucher
)ENGINE=InnoDB;
CREATE TABLE VendorTranslate (
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100) NOT NULL ,
    descriptionSmall varchar (80) NOT NUll,
    descriptionBig text NOT NULL,
    descriptionFull text NOT NULL

)ENGINE=InnoDB;
CREATE TABLE BestOff (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
)ENGINE=InnoDB;
CREATE TABLE BestOffOrder (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idBestOff int NOT NULL,
    FOREIGN KEY (idBestOff) REFERENCES BestOff(id),
    number int -- How to return it in software?
)ENGINE=InnoDB;
CREATE TABLE LabelsBox (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    orderNumber int NOT NULL
)ENGINE=InnoDB;
CREATE TABLE LabelsBoxTranslate (
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100)
)ENGINE=InnoDB;
CREATE TABLE VendorLabelsBox (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox(id)
)ENGINE=InnoDB;
CREATE TABLE VendorImages (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    image varchar(100)
)ENGINE=InnoDB;
CREATE TABLE Highlight (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
)ENGINE=InnoDB;
CREATE TABLE HighlightTranslate (
    idHighlight int NOT NULL,
    FOREIGN KEY (idHighlight) REFERENCES Highlight(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100)
)ENGINE=InnoDB;
CREATE TABLE RatedCategory (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    orderNumber int NOT NULL
)ENGINE=InnoDB;
CREATE TABLE RatedCategoryTranslate (
    idRatedCategory int NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    nameCategory varchar(100) NOT NULL
)ENGINE=InnoDB;
CREATE TABLE Rated (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idRatedCategory int NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    stars int NOT NULL
)ENGINE=InnoDB;
CREATE TABLE IncludedService (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    icon varchar(100)
)ENGINE=InnoDB;
CREATE TABLE IncludedServiceTranslate (
    idIncludedService int NOT NULL,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100) NOT NULL
)ENGINE=InnoDB;
CREATE TABLE VendorIncludedService (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idIncludedService int not null,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService(id)
)ENGINE=InnoDB;
CREATE TABLE AboutActivity (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
)ENGINE=InnoDB;
CREATE TABLE AboutActivityTranslate (
    idAboutActivity int NOT NULL,
    FOREIGN KEY (idAboutActivity) REFERENCES AboutActivity(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    head varchar (100),
    description varchar (200)
)ENGINE=InnoDB;
CREATE TABLE ImportantInformationHead (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
)ENGINE=InnoDB;
CREATE TABLE ImportantInformationDescription (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idImportantInformationHead int NOT NULL,
    FOREIGN KEY (idImportantInformationHead) REFERENCES ImportantInformationHead(id)
)ENGINE=InnoDB;
CREATE TABLE ImportantInformationHeadTranslate (
    idImportantInformationHead int NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (idImportantInformationHead) REFERENCES ImportantInformationHead(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(80)
)ENGINE=InnoDB;
CREATE TABLE ImportantInformationDescriptionTranslate (
    idImportantInformationDescription int NOT NULL AUTO_INCREMENT,
    FOREIGN KEY (idImportantInformationDescription) REFERENCES ImportantInformationDescription(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(80)
)ENGINE=InnoDB;

-- up here have been created DB Scheme


-- //////////////////////////////////////////////
-- our BD

CREATE TABLE VoucherGenerateOptions (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    dayString varchar(100) NOT NULL,
    timeVoucher varchar (100) NOT NULL,
    numberVoucher int NOT NULL

)ENGINE=InnoDB;
-- //////////////////////////////////////////////


CREATE TABLE VoucherRules (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    hasTimeStartRestriction binary(1),
    infantTolerance binary(1) NOT NULL,
    childAcceptance binary(1) NOT NULL
)ENGINE=InnoDB;

-- TODO: this table must be refreshed!
CREATE TABLE VendorVoucher (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    starterVouchers int NOT NULL,
    existenceVoucher int NOT NULL,
    dateVoucher datetime NOT NULL,
    reserved int DEFAULT 0

)ENGINE=InnoDB;

CREATE TABLE VendorVoucherBook (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
)ENGINE=InnoDB;
-- /////////////////////////////////////////////////////////////////
-- For our DB

CREATE TABLE User (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    promotionsAvailable binary(1) NOT NULL,
    password varchar(100) NOT NULL,
    isConfirmed binary(1)
)ENGINE=InnoDB;

CREATE TABLE UserConfirmation(
    idUser int NOT NULL,
    FOREIGN KEY (idUser) REFERENCES User(id),
    confirmationNumber int NOT NULL,
    dateSend datetime
)ENGINE=InnoDB;

CREATE TABLE OrderPayment(
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idUser int NOT NULL,
    FOREIGN KEY (idUser) REFERENCES User(id),
    orderIdUsed varchar(200),
    orderAmount float NOT NULL,
    isPaid int DEFAULT 0,
    datePayment date
)ENGINE=InnoDB;

CREATE TABLE OrderVendorVoucher(
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idOrderPayment int NOT NULL,
    FOREIGN KEY (idOrderPayment) REFERENCES OrderPayment(id),
    idVendorVoucher int NOT NULL,
    FOREIGN KEY (idVendorVoucher) REFERENCES VendorVoucher(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    isAdult binary(1) NOT NULL,
    numberInfants int
);

CREATE TABLE Voucher (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendorVoucher int NOT NULL,
    FOREIGN KEY (idVendorVoucher) REFERENCES VendorVoucher(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idOrder int,
    FOREIGN KEY (idOrder) REFERENCES OrderPayment(id),
    isAdult binary(1) NOT NULL,
    price int,
    infantNumber int,
    extraMoney int

)ENGINE=InnoDB;


CREATE TABLE Menu (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    orderNumber int NOT NULL
)ENGINE=InnoDB;


CREATE TABLE MenuTranslate (
    idMenu int NOT NULL,
    FOREIGN KEY (idMenu) REFERENCES Menu(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES Language(id),
    name varchar(100) NOT NULL
)ENGINE=InnoDB;



-- Some data for menu and language


INSERT INTO `Language` (`id`, `language`, `icon`) VALUES
(1, 'Ελληνικά', 'gr'),
(2, 'English', 'gb');


INSERT INTO `Menu` (`id`, `orderNumber`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14);


INSERT INTO `MenuTranslate` (`idMenu`, `idLanguage`, `name`) VALUES
(1, 1, 'Αρχική'),
(2, 1, 'Πως λειτουργεί'),
(3, 1, 'Τοποθεσίες'),
(4, 1, 'Δραστηριότητες'),
(5, 1, 'Ερωτήσεις'),
(6, 1, 'Εγγραφή'),
(1, 2, 'Home'),
(2, 2, 'How it works'),
(3, 2, 'Locations'),
(4, 2, 'Experiences'),
(5, 2, 'FAQ`s'),
(6, 2, 'Sign Up'),
(7, 1, 'Γλώσσα'),
(7, 2, 'Language'),
(8, 1, 'Καλάθι'),
(8, 2, 'Cart'),
(9, 1, 'Χρήσιμα Links'),
(9, 2, 'Useful links'),
(10, 1, 'Επικοινωνήστε μαζί μας'),
(10, 2, 'Contact with Us'),
(11, 1, 'Όροι και Προϋποθέσεις'),
(11, 2, 'Τerms and Conditions'),
(12, 1, 'Η πολιτική μας'),
(12, 2, 'Our Privacy'),
(13, 1, 'Ακολουθηστε μας'),
(13, 2, 'Follow Us'),
(14, 1, 'Αγοράστε τουλάχιστον 2 vouchers για τις ίδιες ή διαφορετικές δραστηριότητες και το 3ο voucher to λαμβάνετε δωρεάν . Τα δώρα σας δεν τελειώνουν ποτέ!'),
(14, 2, 'Purchase at least 2 vouchers for the same or different activities and up to 3rd voucher you get free vouchers. Your presents never end!');


INSERT INTO `PaymentInfoActivity` (`id`) VALUES (1);
INSERT INTO `PaymentInfoActivity` (`id`) VALUES (2);

INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values (1,2,2.1,"Αγοράστε τώρα ένα κουπόνι VP για την κράτηση της δραστηριότητάς σας και πληρώστε αργότερα για τη δραστηριότητά σας με έκπτωση όταν φτάσετε. Ελέγξτε το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.");
INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values (1, 2,2.1,"Buy a VP voucher for your activity reservation now and pay later for your activity with a discount when you arrive. Check your activity voucher once you have booked for full details.");

INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values (2,1,1.1,"Αγοράστε το κουπόνι VP που κάνετε κράτηση τώρα και πληρώστε αργότερα για τη δραστηριότητά σας με έκπτωση όταν φτάσετε ή μπορείτε να πληρώσετε νωρίτερα αν θέλετε. Ελέγξτε το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.");
INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values (2,2,1.1,"Buy VP Voucher you Reserve Now your Spot & Pay Later for your Activity with a Discount when you arrive, or you can pay earlier if you like. Check your activity voucher once you have booked for full details.");





INSERT INTO RatedCategory(orderNumber)
VALUES (1), (2), (3), (4), (5), (6), (7);
INSERT INTO RatedCategoryTranslate(idRatedCategory, idLanguage, nameCategory)
VALUES (1,1,'Ποιότητα Εξυπηρέτησης Πελατών'),
       (1,2,'Customer Service Quality'),
       (2,1,'Εξατομίκευση & Ευελιξία'),
       (2,2,'Personalization & Flexibility'),
       (3,1,'Πρότυπα ασφάλειας και υγιεινής (συμπεριλαμβανομένου του Covid-19)'),
       (3,2,'Safety & Sanitary Standards (Covid-19 Included)'),
       (4,1, 'Ποιότητα Υλικών'),
       (4,2,'Quality of Materials'),
       (5,1,'Ηθικές Εργασιακές Πρακτικές'),
       (5,2,'Ethical Labor Practices'),
       (6,1,'Περιβαλλοντική Ευθύνη'),
       (6,2,'Environmental Responsibility'),
       (7,1, 'Σεβασμός στους Πολιτιστική Κληρονομιά'),
       (7,2,'Respect for Local Cultures');

  /*
       INSERT INTO IncludedService() VALUES ();
INSERT INTO IncludedServiceTranslate(idIncludedService, idLanguage, name)
VALUES (1,1,'Ελληνικό label'), (1,2,'English label');
 */

INSERT INTO CategoryVendor() VALUES ();
INSERT INTO PaymentInfoActivity() VALUES ();
INSERT INTO Destination() VALUES ();
INSERT INTO Vendor(idDestination, priceAdult, originalPrice, discount, priceKid, idCategory, idPaymentInfoActivity)
VALUES (1, 10, 15, 30, 8, 1, 1);
INSERT INTO VendorVoucher(idVendor, starterVouchers, existenceVoucher, dateVoucher)
VALUES
(1, 10, 10, NOW() + INTERVAL 1 DAY);
INSERT INTO VendorTranslate(idVendor, idLanguage, name, descriptionSmall, descriptionBig, descriptionFull)
values (1,1, 'name1', '', '',''),(1,2,'name2','','','');