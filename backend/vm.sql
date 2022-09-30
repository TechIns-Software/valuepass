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
    isOkForShowing binary(1) DEFAULT 0
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
    isActiveNow            binary(1)      DEFAULT 1
) ENGINE = InnoDB;

create TABLE VendorTranslate
(
    idVendor        int          NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id),
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
    FOREIGN KEY (idVendor) REFERENCES Vendor (id)
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
    FOREIGN KEY (idVendor) REFERENCES Vendor (id),
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox (id)
) ENGINE = InnoDB;

create TABLE VendorImages
(
    id       int,
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id),
    image    varchar(100)
) ENGINE = InnoDB;

create TABLE Highlight
(
    id       int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id)
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
    FOREIGN KEY (idVendor) REFERENCES Vendor (id),
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
    FOREIGN KEY (idVendor) REFERENCES Vendor (id),
    idIncludedService int not null,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService (id)
) ENGINE = InnoDB;
create TABLE AboutActivity
(
    id       int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor (id)
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
    FOREIGN KEY (idVendor) REFERENCES Vendor (id)
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


insert into `Menu` (id)
VALUES (1),
       (2),
       (3),
       (4),
       (5),
       (6),
       (7),
       (8),
       (9),
       (10),
       (11),
       (12),
       (13),
       (14),
       (15),
       (16),
       (17),
       (18),
       (19),
       (20),
       (21),
       (22),
       (23),
       (24),
       (25),
       (26),
       (27),
       (28),
       (29),
       (30),
       (31),
       (32),
       (33),
       (34),
       (35),
       (36),
       (37),
       (38),
       (39),
       (40),
       (41),
       (42),
       (43),
       (44),
       (45),
       (46),
       (47),
       (48),
       (49),
       (50),
       (51),
       (52),
       (53),
       (54),
       (55),
       (56),
       (57),
       (58),
       (59),
       (60),
       (61),
       (62),
       (63),
       (64),
       (65),
       (66),
       (67),
       (68),
       (69),
       (70),
       (71),
       (72),
       (73),
       (74);



insert into `MenuTranslate` (`idMenu`, `idLanguage`, `name`)
VALUES (1, 1, 'Αρχική'),
       (1, 2, 'Home'),

       (2, 1, 'Πως λειτουργεί'),
       (2, 2, 'How it works'),

       (3, 1, 'Τοποθεσίες'),
       (3, 2, 'Locations'),

       (4, 1, 'Δραστηριότητες'),
       (4, 2, 'Experiences'),

       (5, 1, 'Ερωτήσεις'),
       (5, 2, 'FAQ`s'),

       (6, 1, 'Εγγραφή'),
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
       (11, 2, 'Terms and Conditions'),

       (12, 1, 'Η πολιτική μας'),
       (12, 2, 'Our Privacy'),

       (13, 1, 'Ακολουθήστε μας'),
       (13, 2, 'Follow Us'),

       (14, 1,
        'Αγοράστε τουλάχιστον 2 vouchers για τις ίδιες ή διαφορετικές δραστηριότητες και το 3ο voucher το λαμβάνετε δωρεάν. Τα δώρα σας δεν τελειώνουν ποτέ!'),
       (14, 2,
        'Purchase at least 2 vouchers for the same or different activities and up to 3rd voucher you get free vouchers. Your presents never end!'),

       (15, 1, 'Οι προσφορές ValuePass είναι διαθέσιμες στο πλοίο'),
       (15, 2, 'ValuePass Offers are only Available Onboard'),

       (16, 1, 'Μην το χάσετε'),
       (16, 2, 'Don`t Miss it'),

       (17, 1, 'Γιατί ValuePass'),
       (17, 2, 'Why ValuePass'),

       (18, 1, 'Ξοδέψτε λιγότερα κάνοντας περισσότερα…'),
       (18, 2, 'Spend less doing more…'),


       (19, 1, 'Εξατομικευμένο'),
       (19, 2, 'Personalized'),

       (20, 1, 'Διαλέξτε τον προορισμό σας, το αξιοθέατο, το πρόγραμμα και δημιουργήστε τη δική σας λίστα'),
       (20, 2, 'Pick your destination, attraction, schedule and create your own bucket list'),

       (21, 1, 'Ειδικά Διαλεγμένο'),
       (21, 2, 'Pampered'),

       (22, 1, 'Έχουμε πάντα ένα δώρο για εσάς.'),
       (22, 2, 'We always have a present for you.'),

       (23, 1, 'Διαβάστε περισσότερα'),
       (23, 2, 'Read More'),

       (24, 1, 'Πληροφορίες '),
       (24, 2, 'Pampered Info'),

       (25, 1, 'Εξοικονομήστε από 20% έως 30% έκπτωση στην αρχική τιμή'),
       (25, 2, 'Save from 20% to 30% discount on the initial price'),

       (26, 1, 'Vouchers + επιπλέον'),
       (26, 2, 'Vouchers  + extra'),

       (27, 1, 'Δωρεάν Voucher'),
       (27, 2, 'Free Voucher'),

       (28, 1, 'Ευέλικτος'),
       (28, 2, 'Flexible'),

       (29, 1, 'Δωρεάν ακύρωση, επιλογές πληρωμής και επαναπρογραμματισμός'),
       (29, 2, 'Free Cancellation, Payment Options & Re-scheduling'),

       (30, 1, 'Πληροφορίες '),
       (30, 2, 'Flexible Info'),

       (31, 1, ' Έυκολος Χειρισμός'),
       (31, 2, 'Convenient'),

       (32, 1, 'Ελέγξτε τα πάντα εύκολα από το smartphone σας.
Λάβετε λεπτομερείς πληροφορίες στο e-mail που προτιμάτε'),
       (32, 2, 'Control everything easily from your smartphone.
Receive detailed info at your preferred e-mail'),

       (33, 1, 'Ασφαλές'),
       (33, 2, 'Secured'),

       (34, 1, 'Υψηλή ασφάλεια  στην διαδικασία πληρωμής'),
       (34, 2, 'Highly secured payment procedure'),

       (35, 1, 'Υποστήριξη'),
       (35, 2, 'Supportive'),

       (36, 1, 'Ρωτήστε όλα όσα θέλετε να μάθετε. Η ομάδα υποστήριξή μας είναι εδώ για να απαντήσει σε κάθε ερώτηση'),
       (36, 2, 'Ask everything you want to know. Our support team is here to answer every question'),

       (37, 1, 'Προορισμοί'),
       (37, 2, 'Destinations'),

       (38, 1, 'Δημιουργήστε τη λίστα  των δραστηριοτήτων σας  εν πλω!'),
       (38, 2, 'Create your bucket list on board!'),

       (39, 1, 'Αγοράστε τουλάχιστον 2 Voucher.'),
       (39, 2, 'Buy at least 2 vouchers.'),

       (40, 1, 'Με τρία η περισσότερα'),
       (40, 2, 'With 3 or more '),

       (41, 1, 'παίρνετε δωρεάν vouchers'),
       (41, 2, 'you get your free vouchers '),

       (42, 1, 'και τα δώρα δεν τελειώνουν ποτέ'),
       (42, 2, ' and your presents never end!'),

       (43, 1, 'Αγαπημένες Δραστηριότητες '),
       (43, 2, 'Best of Experiences'),

       (44, 1, 'Τύπος Δραστηριότητας'),
       (44, 2, 'Type of experience'),

       (45, 1, 'Βαθμολογία Κριτηρίων'),
       (45, 2, 'Our Criteria Rating'),

       (46, 1, 'Διαθέσιμα Vouchers'),
       (46, 2, 'Vouchers Available'),

       (47, 1, 'Αγόρασε το VP Voucher'),
       (47, 2, 'Buy VP Voucher'),

       (48, 1, 'Αγόρασε το VP Voucher'),
       (48, 2, 'Buy VP Voucher'),

       (49, 1, 'Απο'),
       (49, 2, 'From'),

       (50, 1, 'Πλήρωσε'),
       (50, 2, 'Pay'),

       (51, 1, 'Εξοικονόμησε'),
       (51, 2, 'Save'),

       (52, 1, 'συνολικά'),
       (52, 2, 'in total'),

       (53, 1, 'Κάνε Κράτηση'),
       (53, 2, 'Book Now '),

       (54, 1, 'Αποδράστε από τις τουριστικές παγίδες με αξέχαστες ταξιδιωτικές εμπειρίες.'),
       (54, 2, 'Escape the tourist traps with unforgettable travel experiences.'),

       (55, 1, 'Μπείτε κάτω από την επιφάνεια αυτών των προορισμών.'),
       (55, 2, 'Get beneath the surface of these destinations.'),

       (56, 1, 'Όλες οι προτάσεις μας επιλέγονται από την ομάδα μας!'),
       (56, 2, ' All our proposals are hand-picked by our team!'),

       (57, 1, 'Εμπνευστείτε για το επόμενο ταξίδι σας'),
       (57, 2, 'Get inspired for your next trip '),

       (58, 1, 'Αγοράστε τα Voucher σας στο πλοίο κρατήστε τη θέση σας,'),
       (58, 2, 'Buy your vouchers on board reserve your spot, '),

       (59, 1, 'και πληρώστε τον πάροχο με έκπτωση'),
       (59, 2, 'and pay the provider  with a discount'),

       (60, 1, 'όταν φτάσεις στην τοποθεσία δραστηριότητάς σας.'),
       (60, 2, 'when you arrive at your activity location. '),

       (61, 1, 'Περιγραφή'),
       (61, 2, 'Description'),

       (62, 1, 'Σχετικά με την Δραστηριότητα'),
       (62, 2, 'About this Activity'),

       (63, 1, 'Highlights'),
       (63, 2, 'Highlights'),

       (64, 1, 'Λεπτομερής Περιγραφή'),
       (64, 2, 'Full Description'),

       (65, 1, 'Τι παρέχονται '),
       (65, 2, 'Includes'),

       (66, 1, 'Σημαντικές Πληροφορίες'),
       (66, 2, 'Important information'),

       (67, 1, 'Όλοι οι προμηθευτές πληρούν τα επτά πρότυπα της αξιολόγησής μας'),
       (67, 2, 'All of our suppliers have met the seven standards of our rating'),

       (68, 1, 'Ελέγξτε διαθεσιμότητα'),
       (68, 2, 'Check availability'),

       (69, 1, 'Ενήλικες'),
       (69, 2, 'Adults'),

       (70, 1, 'Παιδία'),
       (70, 2, 'Children'),

       (71, 1, 'Μωρά'),
       (71, 2, 'Infants'),

       (72, 1,
        'Τα Voucher ValuePass δεν ακυρώνονται, αλλά προσπαθούμε πάντα να σας προσφέρουμε τις καλύτερες εναλλακτικές λύσεις σχετικά με τους παρόχους δραστηριοτήτων που προωθούμε, εάν κάτι πάει στραβά. Θα βρείτε περισσότερες πληροφορίες στο email επιβεβαίωσης'),
       (72, 2,
        'ValuePass vouchers are not canceled, but we are always looking to offer you the best alternative solutions regarding the activity providers we promote if something goes wrong. You`ll find more information in your confirmation email'),

       (73, 1, 'Διάλεξε Ημερομηνία'),
       (73, 2, 'Choose your date'),

       (74, 1, 'Δεν υπάρχει κάποια χρέωση σε αυτό το βήμα'),
       (74, 2, 'No money charged in this step');



insert into `PaymentInfoActivity` (id)
VALUES (1),
       (2);

insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`)
values (1, 2, 2.1,
        'Αγοράστε τώρα ένα κουπόνι VP για την κράτηση της δραστηριότητάς σας και πληρώστε αργότερα για τη δραστηριότητά σας με έκπτωση όταν φτάσετε. Ελέγξτε το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.');
insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`)
values (1, 2, 2.1,
        'Buy a VP voucher for your activity reservation now and pay later for your activity with a discount when you arrive. Check your activity voucher once you have booked for full details.');

insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`)
values (2, 1, 1.1,
        'Αγοράστε το κουπόνι VP που κάνετε κράτηση τώρα και πληρώστε αργότερα για τη δραστηριότητά σας με έκπτωση όταν φτάσετε ή μπορείτε να πληρώσετε νωρίτερα αν θέλετε. Ελέγξτε το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.');
insert into `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`)
values (2, 2, 1.1,
        'Buy your vouchers on board reserve your spot and pay the provider with a discount when you arrive at your activity location.');

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
       (3, 1, 'Πρότυπα ασφάλειας και υγιεινής (συμπεριλαμβανομένου του Covid-19)'),
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
