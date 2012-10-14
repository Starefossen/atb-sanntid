<?php
/**
 * Get paths for given bus line
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getPercorsi
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
/**
 * @request _idAzienda 	- unique company ID (1 = AtB)
 * @request _idLinea 	- unique line ID (14 = "5") {@see getLines->cinLinea}
 * @request _isoDate 	- current date (YYYYMMDD)
 * @request _fascia 	- current time (HH:MM)
 * @request _tipoPerc 	- type (@unknown)
 * @request _tLeftLon 	- {@code null} (@unknown)
 * @request _tLeftLat 	- {@code null} (@unknown)
 * @request _bRightLon 	- {@code null} (@unknown)
 * @request _bRightLat 	- {@code null} (@unknown)
 */
 
 {
 	"_idAzienda" 	: "1",
 	"_idLinea" 		: "14",
 	"_isoDate" 		: "20120121",
 	"_fascia" 		: "12:04",
 	"_tipoPerc" 	: "1,4,5",
 	"_tLeftLon"		:null,
 	"_tLeftLat"		:null,
 	"_bRightLon"	:null,
 	"_bRightLat"	:null
 }

 /**
 * @response total 		- Total paths in response
 * @response Percorsi 	- Array of paths
 * 						@cinPercorso 	- {@code integer} unique path id
 * 						@codAzPercorso 	- {@code String} code (@unknown)
 * 						@descrizione 	- {@code String} description (@unknown)
 * 						@capOriDest 	- {@code String} origin and destination (seperated by "-u003e")
 * 						@nCorse 		- {@code integer} course (direction?) (@unknown)
 */

{
	"Percorsi": [
		{
			"cinPercorso"		:185,
			"codAzPercorso"		:"16010008_16010103 1",
			"descrizione"		:"45",
			"capOriDest"		:"[0008] Dronningens gt.                 -u003e [0103] Dragvoll                       ",
			"nCorse"			:480
		},
		{
			"cinPercorso"		:196,
			"codAzPercorso"		:"16010007_16010074",
			"descrizione"		:"39",
			"capOriDest"		:"[0007] Dronningens gt.                 -u003e [0074] Buenget                        ",
			"nCorse"			:472
		},
		{	
			"cinPercorso"		:192,
			"codAzPercorso"		:"16010074_16010008",
			"descrizione"		:"45",
			"capOriDest"		:"[0074] Buenget                         -u003e [0008] Dronningens gt.                ",
			"nCorse"			:496
		},
		{
			"cinPercorso"		:189,
			"codAzPercorso"		:"16011103_16010007 1",
			"descrizione"		:"39",
			"capOriDest"		:"[1103] Dragvoll                        -u003e [0007] Dronningens gt.                ",
			"nCorse"			:472
		}
	],
	"total":"4"
}
?>