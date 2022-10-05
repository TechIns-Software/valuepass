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
       (74),
       (75),
       (76),
       (77),
       (78),
       (79),
       (80),
       (81),
       (82),
       (83),
       (84),
       (85),
       (86),
       (87),
       (88),
       (89),
       (90),
       (91),
       (92),
       (93),
       (94),
       (95),
       (96),
       (97),
       (98),
       (99),
       (100),
       (101),
       (102),
       (103),
       (104),
       (105),
       (106),
       (107),
       (108),
       (109),
       (110),
       (111),
       (112),
       (113),
       (114),
       (115),
       (116),
       (117),
       (118),
       (119),
       (120),
       (121),
       (122),
       (123),
       (124),
       (125),
       (126),
       (127),
       (128),
       (129),
       (130),
       (131),
       (132),
       (133),
       (134),
       (135),
       (136),
       (137),
       (138);





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
       (5, 2, 'Customer Care'),

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
        'Αγοράστε τουλάχιστον 2 κουπόνια για τις ίδιες ή διαφορετικές δραστηριότητες και από το 3ο  μέχρι το 7ο voucher  λαμβάνετε  δωρεάν vouchers'),
       (14, 2,
        'Purchase at least 2 vouchers for the same or different activities and from the 3rd voucher or more you get extra free vouchers'),

       (15, 1, 'Οι προσφορές ValuePass είναι διαθέσιμες αποκλειστικά στο πλοίο'),
       (15, 2, 'ValuePass Offers are only Available Onboard'),

       (16, 1, 'Μην το χάσετε'),
       (16, 2, 'Don`t Miss it'),

       (17, 1, 'Γιατί ValuePass'),
       (17, 2, 'Why ValuePass'),

       (18, 1, 'Ξοδέψτε λιγότερα κάνοντας περισσότερα…'),
       (18, 2, 'Spend less doing more…'),


       (19, 1, 'Εξατομικευμένο'),
       (19, 2, 'Personalized'),

       (20, 1, 'Διαλέξτε τον προορισμό σας, το αξιοθέατο, το πρόγραμμα και δημιουργήστε τη δική σας λίστα εμπειριών'),
       (20, 2, 'Pick your destination, attraction, schedule and create your own bucket list'),

       (21, 1, 'Ειδικά Διαλεγμένο'),
       (21, 2, 'Pampered'),

       (22, 1, 'Έχουμε πάντα δώρα για εσάς.'),
       (22, 2, 'We always have a present for you.'),

       (23, 1, 'Διαβάστε περισσότερα'),
       (23, 2, 'Read More'),

       (24, 1, 'Λεπτομέρειες: '),
       (24, 2, 'Pampered Info'),

       (25, 1, 'Eξασφαλίστε από 5% έως 30% έκπτωση από την αρχική τιμή'),
       (25, 2, 'Save from 5% to 30% discount on the initial price'),

       (26, 1, 'Voucher + επιπλέον'),
       (26, 2, 'Vouchers  + extra'),

       (27, 1, 'Δωρεάν Voucher'),
       (27, 2, 'Free Voucher'),

       (28, 1, 'Ευέλικτο'),
       (28, 2, 'Flexible'),

       (29, 1, 'Δωρεάν ακύρωση, επιλογές πληρωμής & Επαναπρογραμματισμού'),
       (29, 2, 'Free Cancellation, Payment Options & Re-scheduling'),

       (30, 1, 'Ευελιξία  '),
       (30, 2, 'Flexible Info'),

       (31, 1, 'Εύκολος Χειρισμός'),
       (31, 2, 'Convenient'),

       (32, 1, 'Ελέγξτε τα πάντα εύκολα από το smartphone σας.Λάβετε λεπτομερείς πληροφορίες στο e-mail σας'),
       (32, 2, 'Control everything easily from your smartphone.Receive detailed info at your preferred e-mail'),

       (33, 1, 'Ασφάλεια & Προσωπικά Δεδομένα '),
       (33, 2, 'Security & Personal Data '),

       (34, 1, 'Εξαιρετικά διασφαλισμένη διαδικασία πληρωμής & προσωπικών δεδομένων'),
       (34, 2, 'Highly secure payment procedure & highly secure personal data'),

       (35, 1, 'Αμεση Υποστήριξη'),
       (35, 2, 'Supportive'),

       (36, 1, 'Ρωτήστε όλα όσα θέλετε να μάθετε. Η ομάδα υποστήριξής μας είναι εδώ για να απαντήσει σε κάθε ερώτησή σας.'),
       (36, 2, 'Ask everything you want to know. Our support team is here to answer every question'),

       (37, 1, 'Προορισμοί'),
       (37, 2, 'Destinations'),

       (38, 1, 'Δημιουργήστε τη λίστα  των δραστηριοτήτων σας  εν πλω!'),
       (38, 2, 'Create your bucket list on board!'),

       (39, 1, 'Αγοράστε τουλάχιστον 2 Voucher'),
       (39, 2, 'Buy at least 2 vouchers'),

       (40, 1, 'Με 3 η περισσότερα'),
       (40, 2, 'With 3 or more '),

       (41, 1, 'παίρνετε δωρεάν vouchers'),
       (41, 2, 'you get your free vouchers '),

       (42, 1, 'και τα δώρα δεν τελειώνουν ποτέ'),
       (42, 2, ' and your gifts never end!'),

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

       (58, 1, 'Αγοράστε τα vouchers εν πλω, κρατήστε τη θέση σας,'),
       (58, 2, 'Buy your vouchers on board reserve your spot, '),

       (59, 1, 'και πληρώστε τον πάροχο με έκπτωση '),
       (59, 2, 'and pay the provider  with a discount'),

       (60, 1, 'όταν φτάσετε στην τοποθεσία της δραστηριότητας.'),
       (60, 2, 'when you arrive at your activity location. '),

       (61, 1, 'Περιγραφή'),
       (61, 2, 'Description'),

       (62, 1, 'Σχετικά με την Δραστηριότητα'),
       (62, 2, 'About this Activity'),

       (63, 1, 'Highlights'),
       (63, 2, 'Highlights'),

       (64, 1, 'Λεπτομερής Περιγραφή'),
       (64, 2, 'Full Description'),

       (65, 1, 'Τι περιλαμβάνει'),
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
        'Τα κουπόνια ValuePass δεν ακυρώνονται, ωστόσο πάντα σας προσφέρουμε τις καλύτερες εναλλακτικές λύσεις στην περίπτωση που πάει κάτι στραβά σε σχέση με τον πάροχο δραστηριοτήτων που προωθούμε . Θα βρείτε περισσότερες πληροφορίες στο email επιβεβαίωσης'),
       (72, 2,
        'ValuePass vouchers can not be canceled, but we are always looking to offer you the best alternative solutions regarding the activity providers we promote if something goes wrong. You will find more information in your confirmation email'),

       (73, 1, 'Διαέξτε Ημερομηνία'),
       (73, 2, 'Choose your date'),

       (74, 1, 'Δεν υπάρχει κάποια χρέωση σε αυτό το βήμα'),
       (74, 2, 'No money charged in this step'),

       (75, 1, 'Δες πώς ξοδεύοντας λιγότερα χρήματα βιώνεις περισσότερες εμπειρίες.'),
       (75, 2, 'See how you can spend less money and do more from our platform'),

       (76, 1, 'Βήμα'),
       (76, 2, 'Step '),

       (77, 1, 'Διάλεξε τον προορισμό σου'),
       (77, 2, 'Choose your destination'),

       (78, 1, 'Διαλέξτε την εμπειρία σας'),
       (78, 2, 'Choose your experience '),

       (79,1, 'Κλείσε την δραστηριότητα που σε ενδιαφέρει '),
       (79, 2, 'Book your activity '),

       (80,1, 'Διαλέξτε πότε θέλετε να την πραγματοποιήσετε'),
       (80, 2, 'Choose your schedule '),

       (81,1, 'Βάλτε τη στο καλάθι'),
       (81, 2, 'Add to the cart'),

       (82,1, 'Αγόραστε τα vouchers εν πλω, κλείστε τη θέση σας και πλήρωστε τον πάροχο με έκπτωση όταν φτάσετε στην τοποθεσία της δραστηριότητας. (Δείτε το voucher της δραστηριότητας για όλες τις λεπτομέρειες.)'),
       (82, 2, 'Buy your vouchers on board reserve your spot, and pay the provider with a discount when you arrive at your activity location. (Check your activity voucher once you book for full details). '),

       (83,1, 'Αγόραστε το λιγότερο 2 vouchers. Αγοράζοντας 3 ή παραπάνω, κερδίζετε δωρεάν vouchers & τα δώρα σας από την ValuePass δε σταματούν ποτέ!'),
       (83, 2, 'Buy at least two (2) Vouchers, with 3 or more you get extra free vouchers and your gifts never end!'),

       (84,1, 'Εξασφάλισε από 5% έως 30% έκπτωση από τις αρχικές τιμές'),
       (84, 2, 'Save from 5% to 30% plus discount on the initial price'),

       (85,1, 'Με'),
       (85, 2, ' '),

       (86,1, 'Συμπληρώστε το όνομα, το κινητό τηλέφωνο και το email σας εδώ.'),
       (86, 2, 'Enter your name, phone number, and email address here. '),

       (87,1, 'Όνομα'),
       (87, 2, 'Name'),

       (88,1, 'Τηλέφωνο: (όλες οι κλήσεις ή τα μηνύματα πραγματοποιούνται μέσω Viber, WhatsApp ή άλλων εφαρμογών δωρεάν κλήσεων εκτός αν οριστεί αλλιώς)'),
       (88, 2, 'Phone: (all calls or messages are made through Viber, WhatsApp, or other free calling apps unless otherwise stated)'),

       (89,1, 'Πληρώνετε μέσω χρεωστικής/πιστωτικής κάρτας και λαμβάνετε μέσω email το QR code και όλες τις απαραίτητες πληροφορίες (Πληροφορίες προμηθευτή - Λεπτομέρειες/Στοιχεία επικοινωνίας- Google maps locator κλπ)'),
       (89, 2, 'Pay with your debit/credit card and receive the QR code and all needed information in your email (Supplier Information – Contact Details + Google Maps Location Pin, etc.)'),

       (90,1, 'Αν δεν μπορείτε να παραβρεθείτε στην δραστηριότητα, πρέπει να ακυρώσετε εντός 12 έως 24 ωρών πριν την πραγματοποίηση της δραστηριότητας, ανάλογα με τον πάροχο της και την πολιτική ακύρωσης του.'),
       (90, 2, 'If you are unable to attend the attraction, you must cancel it at least from 12 hours to 24 hours in advance, depending on the activity provider. (Check your activity voucher once you book for full details)'),

       (91,1, 'Θα θέλαμε να σας ενημερώσουμε ότι τα στοιχεία της χρεωστικής/πιστωτικής σας κάρτας διαγράφονται αμέσως μετά την ολοκλήρωση της πληρωμής.'),
       (91, 2, 'We would like to inform you that your debit/credit card details are immediately deleted at the end of the payment process.'),

       (92,1, 'Τα στοιχεία της κάρτας σας διαγράφονται αμέσως μετά την ολοκλήρωση της αγοράς του ValuePass Voucher.'),
       (92, 2, 'Your debit/credit card details are immediately deleted at the end of the Valuepass Voucher payment process.'),

       (93,1, 'Κατά την εγγραφή μου συναινώ ότι ο πάροχος της δραστηριότητας μπορεί να ενημερωθεί για την κράτησή μου μέσω email βάσει της πολιτικής απορρήτου της ValuePass.'),
       (93, 2, 'By signing up, I agree that the activity provider may be informed of my booking via email under the ValuePass privacy policy'),

       (94,1, 'Σας ενημερώνουμε ότι τα προσωπικά σας στοιχεία χρησιμοποιούνται μόνο και αποκλειστικά για το λόγο που τα υποβάλλατε στην ValuePass και διαγράφονται μετά από την πάροδο 3 μηνών (όνομα, τηλέφωνο, email)'),
       (94, 2, 'We inform you that your personal data is used exclusively and only for the scope you have submitted to us and is deleted after three months. (name, phone number, email).'),

       (95,1, 'Κατά την εγγραφή μου συναινώ ότι θα λάβω email υπενθύμισης 2 με 6 ώρες πριν την λήξη της ακύρωσης ή για την επιβεβαίωση της δραστηριότητας μου, σύμφωνα με την πολιτική ακύρωσης που ορίζει ο πάροχος της δραστηριότητας.
Επίσης στο  email θα υπάρχει δυνατότητα επιλογής και νέων δραστηριοτήτων.'),
       (95, 2, 'By signing up I agree to receive a reminder email 2 to 6 hours before the cancellation deadline or to confirm my activity, according to the cancellation policy set by the activity provider.
Also, in the email, there will be a possibility to choose new activities.'),

       (96,1, 'Όροι και Προϋποθέσεις '),
       (96, 2, 'General Terms and Conditions '),

       (97,1, 'Δείτε εδώ τους διαθέσιμους προορισμούς'),
       (97, 2, 'Check here the available destinations'),

       (98,1, 'Καλάθι Αγορών'),
       (98, 2, 'Cart'),

       (99,1, 'Φωτογραφία'),
       (99, 2, 'Image'),

       (100,1, 'Δραστηριότητα'),
       (100, 2, 'Experience'),

       (101,1, 'Ημερομηνία'),
       (101, 2, 'Date'),

       (102,1, 'Vouchers'),
       (102, 2, 'Vouchers'),

       (103,1, 'Συνολική τιμή'),
       (103, 2, 'Total Price'),

       (104,1, 'Διαγραφή'),
       (104, 2, 'Delete'),

       (105,1, 'Σύνολο'),
       (105, 2, 'Total'),

       (106,1, 'Συνολικά Voucher'),
       (106, 2, 'Total Vouchers Get'),

       (107,1, 'Voucher που πλήρωσες'),
       (107, 2, 'Vouchers Pay'),

       (108,1, 'Voucher που πήρες δώρο'),
       (108, 2, 'Vouchers Get Free'),

       (109,1, 'Συνέχεια στις αγορές'),
       (109, 2, 'Continue Shopping'),

       (110,1, 'Πληρωμή'),
       (110, 2, 'Checkout'),

       (111,1, 'Ενήλικες'),
       (111, 2, 'Adults'),

       (112,1, 'Παιδία'),
       (112, 2, 'Children'),

       (113,1, 'Μωρά'),
       (113, 2, 'Infants'),

       (114,1, 'Δες την προσφορά'),
       (114, 2, 'Check the offer'),

       (115,1, 'Επιλέξτε τουλάχιστον 2 κουπόνια για να συνεχίσετε'),
       (115, 2, 'Select at least 2 vouchers to continue'),

       (116,1, 'Αν επιλέξεις 2 '),
       (116, 2, 'If you select  2'),

       (117,1, 'ακόμα Voucher,θα λάβεις 1'),
       (117, 2, 'vouchers more, you get  1'),

       (118,1, 'δωρεάν'),
       (118, 2, 'free'),

       (119,1, 'Μπορείς να επιλέξεις ακόμα '),
       (119, 2, 'You can select '),

       (120,1, 'Voucher'),
       (120, 2, 'more voucher'),

       (121,1, 'Έχετε επιλέξει τα μέγιστα Vouchers.'),
       (121, 2, 'You have the maximum vouchers selected.'),

       (122,1, 'Μπορείτε να πάρετε ένα Voucher δωρεάν!'),
       (122, 2, 'You can get one voucher free!'),

       (123,1, 'Δες περισσότερες δραστηριότητες'),
       (123, 2, 'See more αctivities'),

       (124,1, 'Τώρα μπορείτε να επωφεληθείτε από τις προσφορές του Valuepass'),
       (124, 2, 'Spend less money and  do more with Valuepass Offers'),

       (125,1, 'από μια ή περισσότερες δραστηριότητες. '),
       (125, 2, 'from the same or more activities.'),

       (126,1, 'To voucher'),
       (126, 2, 'The'),

       (127,1, 'μόλις προστέθηκε στο καλάθι σας.'),
       (127, 2, 'voucher has just been added to your shopping cart.'),

       (128,1, 'Συνεχίστε τις αγορές σας'),
       (128, 2, 'Continue Shopping'),

       (129,1, 'Πηγαίντε στο καλάθι'),
       (129, 2, 'Co to cart'),

       (130,1, 'Δεν υπάρχουν Vouchers στο καλάθι'),
       (130, 2, 'No Vouchers in the card'),

       (131,1, 'Επιστρέψτε και επιλέξτε την Εμπειρία σας'),
       (131, 2, 'Go back and select your experience'),

       (132,1, 'Για πελάτες'),
       (132, 2, 'For Customers'),

       (133,1, 'Για προμηθευτές'),
       (133, 2, 'For Suppliers'),

       (134,1, 'Άλλο'),
       (134, 2, 'Other'),

       (135,1, 'Αγοράστε τα κουπόνια σας εν πλ κρατήστε τη θέση σας και πληρώστε τον πάροχο με
έκπτωση όταν φτάσετε στην τοποθεσία δραστηριότητάς σας'),
       (135, 2, 'Buy your vouchers on board reserve your spot and pay the provider with a
discount when you arrive at your activity location'),

       (136,1, 'Τα vouchers της ValuePass δεν ακυρώνονται, αλλά προσπαθούμε πάντα να σας προσφέρουμε
τις καλύτερες εναλλακτικές λύσεις σχετικά με τους παρόχους δραστηριοτήτων που προωθούμε εάν
κάτι πάει στραβά. Θα βρείτε περισσότερες πληροφορίες στο email επιβεβαίωσης.'),
       (136, 2, 'ValuePass vouchers are not canceled, but we are always looking to offer you
the best alternative solutions regarding the activity providers we promote if
something goes wrong. You`ll find more information in your confirmation email.'),

       (137,1, 'Πολιτική ακύρωσης δραστηριότητας ισχύει έως και 24 ώρες σύμφωνα με την Πολιτική Προμηθευτών του Παρόχου'),
       (137, 2, 'Activity Cancellation Policy up to 24 hours according to Provider`s Supplier Policy'),

       (138,1,'Προφυλάξεις για τον Covid-19 Ισχύουν ειδικά μέτρα υγείας και ασφάλειας. Ελεγχος
το κουπόνι δραστηριότητάς σας μόλις κάνετε κράτηση για πλήρεις λεπτομέρειες.'),
       (138, 2,'Covid-19 precautions Special health and safety measures are in place. Check
your activity voucher once you book for full details.');














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

