<?php
$sql1 = "CREATE TABLE Machine_data (
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
);";


$insert = 'INSERT INTO Machine(machineId, name, description, rowsQty, rowsFixedDistance, doubleLineConfig, machineFamilyId, updated_at, created_at) VALUES (1 , asd, asd, 10, 0.1750, 0, 0, CURDATE(), CURDATE());';
