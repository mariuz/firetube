/****************** GENERATORS ********************/

CREATE GENERATOR GEN_MOVIES_ID;
/******************** DOMAINS *********************/

/******************* PROCEDURES ******************/

/******************** TABLES **********************/

CREATE TABLE MOVIES
(
  ID Integer NOT NULL,
  FILENAME Varchar(512) NOT NULL,
  PRIMARY KEY (ID)
);

/******************** TRIGGERS ********************/

SET TERM ^ ;
CREATE TRIGGER MOVIES_BI FOR MOVIES ACTIVE
BEFORE INSERT POSITION 0
AS

BEGIN

IF (NEW.ID IS NULL) THEN

NEW.ID = GEN_ID(GEN_MOVIES_ID, 1);

END^
SET TERM ; ^
SET TERM ^ ;

GRANT DELETE, INSERT, REFERENCES, SELECT, UPDATE
 ON MOVIES TO  SYSDBA WITH GRANT OPTION;

