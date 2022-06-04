CREATE TABLE language (
    id int NOT NULL,
    language varchar(100),
    icon varchar(50)
);
CREATE TABLE Destination (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    image1 varchar (100),
    image2 varchar (100),
);
CREATE TABLE DestinationTranslate (
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    name varchar (100),
    description text
);
CREATE TABLE CategoryVendor (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
);
CREATE TABLE CategoryVendorTranslate (
    idCategoryVendor int NOT NULL,
    FOREIGN KEY (idCategoryVendor) REFERENCES CategoryVendor(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(100)
);
CREATE TABLE PaymentInfoActivity (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
);
CREATE TABLE PaymentInfoActivityTranslate (
    idPaymentInfoActivity int NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    head varchar(100),
    description varchar (200)

);
CREATE TABLE Vendor (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    priceAdult int NOT NULL,
    originalPrice int NOT NULL,
    discount int NOT NULL,
    priceKid int NOT NULL,
    imageBasic varchar(100),
    idCategory int NOT NULL,
    FOREIGN KEY (idCategory) REFERENCES CategoryVendor(id),
    idPaymentInfoActivity int NOT NULL,
    FOREIGN KEY (idPaymentInfoActivity) REFERENCES PaymentInfoActivity(id),

);
CREATE TABLE VendorTranslate (
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(100) NOT NULL ,
    descriptionSmall varchar (80) NOT NUll,
    descriptionBig text NOT NULL,
    descriptionFull text NOT NULL,

);
CREATE TABLE BestOff (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idDestination int NOT NULL,
    FOREIGN KEY (idDestination) REFERENCES Destination(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
);
CREATE TABLE BestOffOrder (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idBestOff int NOT NULL,
    FOREIGN KEY (idBestOff) REFERENCES BestOff(id),
    int number --How to return it in software?
);
CREATE TABLE LabelsBox(
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    order int NOT NULL
);
CREATE TABLE LabelsBoxTranslate (
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(100)
);
CREATE TABLE VendorLabelsBox (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idLabelsBox int NOT NULL,
    FOREIGN KEY (idLabelsBox) REFERENCES LabelsBox(id)
);
CREATE TABLE VendorImages (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    image varchar(100)
);
CREATE TABLE Highlight (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
);
CREATE TABLE HighlightTranslate (
    idHighlight int NOT NULL,
    FOREIGN KEY (idHighlight) REFERENCES Highlight(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(100)
);
CREATE TABLE RatedCategory (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    orderNumber int NOT NULL,
);
CREATE TABLE RatedCategoryTranslate (
    idRatedCategory int NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    nameCategory varchar(100) NOT NULL
);
CREATE TABLE Rated (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idRatedCategory int NOT NULL,
    FOREIGN KEY (idRatedCategory) REFERENCES RatedCategory(id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    stars int NOT NULL
);
CREATE TABLE IncludedService (
    id int NOT NULL AUTO_INCREMENT,
    icon varchar(100)
);
CREATE TABLE IncludedServiceTranslate (
    idIncludedService int NOT NULL,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(100) NOT NULL
);
CREATE TABLE VendorIncludedService (
    id int NOT NULL AUTO_INCREMENT, -- not sure needed
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    idIncludedService int not null,
    FOREIGN KEY (idIncludedService) REFERENCES IncludedService(id)
);
CREATE TABLE AboutActivity (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
);
CREATE TABLE AboutActivityTranslate (
    idAboutActivity int NOT NULL,
    FOREIGN KEY (idAboutActivity) REFERENCES AboutActivity(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    head varchar (100),
    description varchar (200)
);
CREATE TABLE ImportantInformationHead (
    id int NOT NULL,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id)
);
CREATE TABLE ImportantInformationDescription (
    id int NOT NULL,
    PRIMARY KEY (id),
    idImportantInformationHead int NOT NULL,
    FOREIGN KEY (idImportantInformationHead) REFERENCES ImportantInformationHead(id)
);
CREATE TABLE ImportantInformationHeadTranslate (
    idImportantInformationHead int NOT NULL,
    FOREIGN KEY (idImportantInformationHead) REFERENCES ImportantInformationHead(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(80),
);
CREATE TABLE ImportantInformationDescriptionTranslate (
    idImportantInformationDescription int NOT NULL,
    FOREIGN KEY (idImportantInformationDescription) REFERENCES ImportantInformationDescription(id),
    idLanguage int NOT NULL,
    FOREIGN KEY (idLanguage) REFERENCES language(id),
    name varchar(80),
);

-- up here have been created DB Scheme






CREATE TABLE Payment(
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
);



CREATE TABLE Voucher (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVendor int NOT NULL,
    FOREIGN KEY (idVendor) REFERENCES Vendor(id),
    price_adult int NOT NULL ,
    price_kid int NOT NULL,
    date_restriction binary,
    date DATE,
    categoryId int NOT NULL,
    FOREIGN KEY (categoryId) REFERENCES Category(id),
--     user id someway to store
    status int NOT NULL, --taken, reserve until payment, free
--     somehow to know if can be free

);


CREATE TABLE VoucherOfPayments (
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    idVoucher int NOT NULL,
    FOREIGN KEY (idVoucher) REFERENCES Voucher(id),
    idPayment int NOT NULL,
    FOREIGN KEY (idPayment) REFERENCES Payment(id)
);

