



-- Some data for menu and language


INSERT INTO `Language` (`id`, `language`, `icon`) VALUES
(1, 'Ελληνικά', 'gr'),
(2, 'English', 'gb');


INSERT INTO `menu` (`id`, `orderNumber`) VALUES
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
(13, 13);


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
(13, 2, 'Follow Us');



INSERT INTO `CategoryVendor` (`id`) VALUES (1);

INSERT INTO `CategoryVendorTranslate` (`idCategoryVendor`, `idLanguage`, name) VALUES (1,1,"ΙΣΤΟΡΙΚΟ");
INSERT INTO `CategoryVendorTranslate` (`idCategoryVendor`, `idLanguage`, name) VALUES (1,2,"Historic");




INSERT INTO `PaymentInfoActivity` (`id`) VALUES (1);
INSERT INTO `PaymentInfoActivity` (`id`) VALUES (2);

INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values ("1",1,"Πλήρωσε Τώρα","");
INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values ("1",2,"Pay Now","");

INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values ("2",1,"Πλήρωσε Αργότερα","");
INSERT INTO `PaymentInfoActivityTranslate` (`idPaymentInfoActivity`, `idLanguage`, `head`, `description`) values ("2",2,"Pay Later","");
