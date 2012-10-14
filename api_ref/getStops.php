<?php
/**
 * Get stops for given bus line path
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getFermate
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
/**
 * @request _idAzienda 	- {@code String} unique company ID (1 = AtB)
 * @request _idLinea 	- {@code String} unique line ID (14 = "5") {@see getLines->cinLinea}
 * @request _idPercorso - {@code String} unique path ID (185 = "Dronningens gt. to Dragvoll") {@see getPaths->cinPercorso}
 * @request _tLeftLon 	- {@code null} (@unknown)
 * @request _tLeftLat 	- {@code null} (@unknown)
 * @request _bRightLon 	- {@code null} (@unknown)
 * @request _bRightLat 	- {@code null} (@unknown)
 */
 
 {
 	"_idAzienda"	:"1",
 	"_idLinea"		:"14",
 	"_idPercorso"	:"185",
 	"_tLeftLon"		:null,
 	"_tLeftLat"		:null,
 	"_bRightLon"	:null,
 	"_bRightLat"	:null
 }
 
 /**
 * @response type 		- "FeatureCollection" (@unknown)
 * @response features 	- Array of stops
 * 						@type 			- {@code String} "Feature" (@unknown)
 * 						@geometry 		- {@code array} Array of geometry
 * 											@type 				- {@code String} "Point"
 * 											@coordinates 		- {@code array} 0 => lat, 1 => lon
 * 						@properties 	- {@code array} Array of stop properties
 * 											@Name				- {@code String} Stop name (sms code?) (@unknown)
 * 											@bitMaskProprieta 	- {@code String} "0" (@unknown)
 * 											@Description 		- {@code String} Stop description
 * 											@Id 				- {@code String} Unique stop ID
 */

{
	"type":"FeatureCollection",
	"features":[
		{
			"type":"Feature",
			"geometry": {"type":"Point","coordinates":[1161846,9201463]},
			"properties": {"Name":"0302","bitMaskProprieta":"0","Description":"Moholt                         ","Id":"100107"}
		},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1161384,9202156]},"properties":{"Name":"0301","bitMaskProprieta":"0","Description":"Moholt stud. by                ","Id":"100108"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1158387,9203533]},"properties":{"Name":"0333","bitMaskProprieta":"0","Description":"Gløshaugen Nord                ","Id":"100199"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1159601,9202365]},"properties":{"Name":"0366","bitMaskProprieta":"0","Description":"Berg studentby                 ","Id":"100390"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1156889,9206954]},"properties":{"Name":"0008","bitMaskProprieta":"0","Description":"Dronningens gt.                ","Id":"100402"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1156951,9206631]},"properties":{"Name":"0012","bitMaskProprieta":"0","Description":"Torget                         ","Id":"100509"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1156974,9205436]},"properties":{"Name":"0011","bitMaskProprieta":"0","Description":"Prinsen kino                   ","Id":"100510"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1157191,9204647]},"properties":{"Name":"0477","bitMaskProprieta":"0","Description":"Stud. samfundet                ","Id":"100928"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1165700,9200962]},"properties":{"Name":"0103","bitMaskProprieta":"0","Description":"Dragvoll                       ","Id":"100952"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1165594,9201596]},"properties":{"Name":"0533","bitMaskProprieta":"0","Description":"NTNU Dragvoll                  ","Id":"101133"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1162687,9201381]},"properties":{"Name":"0553","bitMaskProprieta":"0","Description":"Voll studentby                 ","Id":"101247"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1157775,9204418]},"properties":{"Name":"0550","bitMaskProprieta":"0","Description":"Vollabakken                    ","Id":"101248"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1161117,9202966]},"properties":{"Name":"0567","bitMaskProprieta":"0","Description":"Østre Berg                     ","Id":"101353"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1158273,9204065]},"properties":{"Name":"0197","bitMaskProprieta":"0","Description":"Høgskoleringen                 ","Id":"101360"}},
		{"type":"Feature","geometry":{"type":"Point","coordinates":[1158565,9203145]},"properties":{"Name":"0265","bitMaskProprieta":"0","Description":"Gløshaugen Syd                 ","Id":"101766"}}
	]
}
?>