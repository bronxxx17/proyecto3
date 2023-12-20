USE  superhero;
SELECT * FROM alignment ; 
SELECT * FROM attribute ; 
SELECT * FROM colour ; 
SELECT * FROM comic ; 
SELECT * FROM gender ; 
SELECT * FROM publisher ; 
SELECT * FROM race;
SELECT * FROM superhero;
SELECT * FROM superpower;



DELIMITER //
CREATE PROCEDURE spu_listar_hero()
BEGIN
    -- Mostrar los editores disponibles
    SELECT publisher_name AS 'Editores Disponibles' FROM superhero.publisher;
END //


CALL spu_listar_hero();


DELIMITER //
CREATE PROCEDURE spu_buscar_superheroes(IN editorSeleccionado VARCHAR(50))
BEGIN
    -- Buscar y listar datos relacionados con el editor seleccionado
   SELECT sh.superhero_name, sh.full_name, sh.gender_id,  sh.race_id
    FROM superhero.superhero sh
    JOIN superhero.publisher pub ON sh.publisher_id = pub.id
    WHERE pub.publisher_name = editorSeleccionado;
END //


CALL spu_buscar_superheroes ('Dark Horse Comics');




  SELECT sh.superhero_name, sh.full_name, sh.gender_id,  sh.race_id



DELIMITER //
CREATE PROCEDURE spu_Obtene_Alineaciones()
BEGIN
    SELECT alignment_id, COUNT(*) AS alignment_count
    FROM superhero.superhero
    GROUP BY alignment_id;
END //
DELIMITER ;


CALL spu_Obtene_Alineaciones();






DELIMITER //

CREATE PROCEDURE spu_Alignment_Publisher(IN publisherName VARCHAR(50))
BEGIN
    SELECT a.alignment
    FROM superhero.superhero s
    INNER JOIN superhero.alignment a ON s.alignment_id = a.id
    INNER JOIN superhero.publisher p ON s.publisher_id = p.id
    WHERE p.publisher_name = publisherName;
END //

DELIMITER ;





DELIMITER //
CREATE PROCEDURE spu_Contar_Superheroes(
    IN publisherName VARCHAR(50)
)
BEGIN
    SELECT 
        SUM(CASE WHEN a.alignment = 'heroe' THEN 1 ELSE 0 END) as hero_count,
        SUM(CASE WHEN a.alignment = 'villano' THEN 1 ELSE 0 END) as villain_count,
        SUM(CASE WHEN a.alignment = 'neutro' THEN 1 ELSE 0 END) as neutral_count
    FROM superhero.superhero s
    INNER JOIN superhero.alignment a ON s.alignment_id = a.id
    INNER JOIN superhero.publisher p ON s.publisher_id = p.id
    WHERE p.publisher_name = publisherName;
END //
DELIMITER ;

CALL spu_Contar_Superheroes();













