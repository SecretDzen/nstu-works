SET enable_seqscan = false;
SET search_path = v4;

EXPLAIN ANALYSE
SELECT * FROM v4.publ_house
WHERE popularity > 400;

-- BTREE
DROP INDEX IF EXISTS idx_pop_id;

CREATE INDEX
    IF NOT EXISTS idx_pop_id
    ON v4.publ_house (popularity);

EXPLAIN ANALYSE
SELECT * FROM v4.publ_house
WHERE popularity > 400;

-- HASH
DROP INDEX IF EXISTS idx_pop_id;

CREATE INDEX
    idx_pop_id
    ON v4.publ_house
    USING HASH (popularity);

EXPLAIN ANALYSE
SELECT * FROM v4.publ_house
WHERE popularity > 400;

-- LOWER
DROP INDEX IF EXISTS idx_pop_id;

EXPLAIN ANALYSE
SELECT * FROM v4.publ_house
WHERE LOWER(address)  = 'Reality 116';

-- UPPER
DROP INDEX IF EXISTS idx_pop_id;

CREATE INDEX
    IF NOT EXISTS idx_pop_id
    ON v4.publ_house (address);

EXPLAIN ANALYSE
SELECT * FROM v4.publ_house
WHERE UPPER(address)  = 'Reality 116';

ALTER TABLE v4.publ_house
    ADD CONSTRAINT address_id unique (address);