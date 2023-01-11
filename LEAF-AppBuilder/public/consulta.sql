CREATE DATABASE IF NOT EXISTS databasename;
CREATE TABLE IF NOT EXISTS machineData (
            machineId INTEGER NOT NULL UNIQUE,
            name TEXT NOT NULL,
            description TEXT NOT NULL,
            rowsQty INTEGER NOT NULL DEFAULT 0,
            rowsFixedDistance REAL NOT NULL DEFAULT 0,
            doubleLineConfig INTEGER NOT NULL DEFAULT 0,
            machineFamilyId INTEGER,
            PRIMARY KEY (machineId)
        );
