CREATE TABLE Machine_data (
    machineId INTEGER NOT NULL UNIQUE,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    rowsQty INTEGER NOT NULL DEFAULT 0,
    rowsFixedDistance REAL NOT NULL DEFAULT 0,
    doubleLineConfig INTEGER NOT NULL DEFAULT 0,
    machineFamilyId INTEGER,
    updated_at TIMESTAMP,
    created_at TIMESTAMP,
    PRIMARY KEY (machineId AUTOINCREMENT)
);


/*------------------- TABLA NUEVA --------------------*/
CREATE TABLE sensorEcuInputs (
    ecusActuatorsInput INTEGER DEFAULT 0,
    rowsOffsets INTEGER DEFAULT 0,
    rowId INTEGER,
    FOREIGN KEY(rowId) REFERENCES "rows"("rowId");
);

CREATE TABLE "electroValveTypes" (
	"id"	INTEGER NOT NULL UNIQUE,
	"actuatorId"	INTEGER NOT NULL,
	"electroValveType"	INTEGER NOT NULL,
	FOREIGN KEY("actuatorId") REFERENCES "actuators"("id") ON DELETE NO ACTION,
	PRIMARY KEY("id" AUTOINCREMENT)
);
/*Crearla vacia por ahora*/
/*Se usa para config actuadores para cuando hay electro valvulas*/