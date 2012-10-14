<?php
/**
 * Get lines for given company
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getLinee
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
/**
 * @request _idAzienda 	- company ID (1 = AtB)
 * @request _isoDate 	- current date (YYYYMMDD)
 * @request _fascia 	- current time (HH:MM)
 * @request _tipoPerc 	- type (@unknown)
 * @request _tLeftLon 	- {@code null} (@unknown)
 * @request _tLeftLat 	- {@code null} (@unknown)
 * @request _bRightLon 	- {@code null} (@unknown)
 * @request _bRightLat 	- {@code null} (@unknown)
 */
 
 {
 	"_idAzienda"	:"1",
 	"_isoDate"		:"20120121",
 	"_fascia"		:"12:02",
 	"_tipoPerc"		:"1,4,5",
 	"_tLeftLon"		:null,
 	"_tLeftLat"		:null,
 	"_bRightLon"	:null,
 	"_bRightLat"	:null
 }

 /**
 * @response total 		- Total lines in response
 * @response Linee 		- Array of lines
 * 						@cinLinea 		- {@code integer} unique line id
 * 						@codAzLinea 	- {@code String} line number
 * 						@descrizione 	- {@code String} line description
 * 						@nCorse 		- {@code integer} course (direction?) (@unknown)
 * 						@tipoPercorso 	- {@code integer} path type (default 1) (@unknown)
 */

{
	"Linee" : [
		{
			"cinLinea"		:14,
			"codAzLinea"	:"5",
			"descrizione"	:"5",
			"nCorse"		:240,
			"tipoPercorso"	:1
		}
	],
	"total" : 50
}
?>