<?php
/**
 * Get paths for given bus line path
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getPercorsiAlternativi
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
/**
 * @request _idAzienda 	- {@code String} unique company ID (1 = AtB)
 * @request _idPercorso - {@code String} unique path ID (185 = "Dronningens gt. to Dragvoll") {@see getPaths->cinPercorso}
 */
 
 {
 	"_idAzienda"	:"1",
 	"_idPercorso"	:"185"
 }

 /**
 * @response total 		- Total paths in response
 * @response Percorsi 	- Array of paths
 * 						@cinPercorso 	- {@code integer} unique path id
 * 						@idAz 			- {@code String} id? (@unknown)
 * 						@idLinea 		- {@code String} unique line id {@see getLines->response->cinLinea}
 */

{
	"Percorsi": [
		{
			"cinPercorso"	:185,
			"idAz"			:1,
			"idLinea"		:14
		},{
			"cinPercorso"	:195,
			"idAz"			:1,
			"idLinea"		:14
		}
	],
	"total":"2"
}
?>