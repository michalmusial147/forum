
CREATE TABLE IF NOT EXISTS `users` (
  userID INT(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) COLLATE utf8_polish_ci NOT NULL,
  password varchar(256) COLLATE utf8_polish_ci NOT NULL,
  email varchar(50) COLLATE utf8_polish_ci NOT NULL,
  subscription_expiry_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (userID)
) ENGINE=InnoDBInnoDBddd AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE IF NOT EXISTS `Categories` (
  CategoryID INT(11) NOT NULL AUTO_INCREMENT,
  CategoryName text COLLATE utf8_polish_ci NOT NULL,
  ParentCategory INT DEFAULT null,
  PRIMARY KEY (CategoryID),
  FOREIGN KEY (ParentCategory) References Categories(CategoryID)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE IF NOT EXISTS `Threads` (
  ThreadID INT(11) NOT NULL AUTO_INCREMENT,
  ThreadName text COLLATE utf8_polish_ci NOT NULL,
  CategoryID INT,
  DateOpened DateTime,
  Priority int DEFAULT 0,
  PRIMARY KEY (ThreadID),
  FOREIGN KEY (CategoryID) References Categories(CategoryID)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


CREATE TABLE IF NOT EXISTS `Posts` (
  PostID INT(11) NOT NULL AUTO_INCREMENT,
  Content text COLLATE utf8_polish_ci NOT NULL,
  ThreadID INT,
  userID int,
  Posted_on DateTime,
  PRIMARY KEY (PostID),
  FOREIGN KEY (ThreadID) References Threads(ThreadID),
  FOREIGN KEY (userID) References users(userID)

) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TRIGGER  IF NOT EXISTS ThreadsDateTrigger BEFORE INSERT ON Threads FOR EACH ROW
  SET NEW.DateOpened = IFNULL(NEW.DateOpened, CURRENT_DATE);


CREATE TRIGGER  IF NOT EXISTS PostsDateTrigger BEFORE INSERT ON Posts FOR EACH ROW
  SET NEW.Posted_on = IFNULL(NEW.Posted_on, CURRENT_DATE);

