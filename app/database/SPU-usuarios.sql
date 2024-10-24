USE dbasistencia;

-- MECANISMO / FORMAS / TIPOS
-- Instructivo SQL
-- Store Procedure
-- ORM

DROP PROCEDURE IF EXISTS `spu_usuarios_login`;
DELIMITER //
CREATE PROCEDURE spu_usuarios_login(IN _nomuser VARCHAR(20))
BEGIN
	SELECT 
		US.idusuario,
        PE.apellidos, PE.nombres,
        PR.perfil, PR.nombrecorto,
        Us.nomuser, US.passuser
		FROM usuarios US
        INNER JOIN personas PE ON PE.idpersona = US.idpersona
        INNER JOIN perfiles PR ON PR.idperfil = US.idperfil
        WHERE nomuser = _nomuser AND US.inactive_at IS NULL;
END //

