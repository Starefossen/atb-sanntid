<?php
/**
 * Get schedule
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getOrari
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
/**
 * @request _idAzienda 	- {@code String} unique company ID (1 = AtB)
 * @request _idLinea 	- {@code String} unique line ID (14 = "5") {@see getLines->response->cinLinea}
 * @request _idFermata 	- {@code integer} unique stop ID (100509 = "0012 (Torget)") {@see getStops->resonse->features->properties->Id}
 * @request _isoDate 	- {@code String} current date (YYYY-MM-DD)
 * @request _fascia 	- {@code String} current time (HH:MM)
 */
 
 {
 	"_idAzienda"	:"1",
 	"_idLinea"		:"14",
 	"_idFermata"	:100509,
 	"_isoDate"		:"2012-01-21",
 	"_fascia"		:"13:45"
 }
 
 /**
 * @response total 		- {@code integer} number of scheduled arrivals in response
 * @response InfoNodo 	- Array with information about the stop
 * 						@nomeAz 			- {@code String} Stop company name
 * 						@codAzNodo 			- {@code String} Stop code (@unknown)
 * 						@nomeNodo 			- {@code String} Stop name
 * 						@descrNodo 			- {@code String} Stop description
 * 						@bitMaskProprieta 	- {@code String} "" (@unknown)
 * 						@codeMobile 		- {@code String} Stop mobile code
 * 						@coordLon 			- {@code String} Stop geo lon
 * 						@coordLat 			- {@code String} Stop geo lat
 * @response Orari 		- Array with next scheduled bus arrival
 * 						@codAzLinea 		- {@code String} Line number
 * 						@descrizioneLinea 	- {@code String} Line description
 * 						@orario 			- {@code String} Line new arrival
 * 						@orarioSched 		- {@code String} Line sheduled arrival
 * 						@statoPrevisione 	- {@code String} Line status at last stop ("Prev" = delayed, "sched" = on schedule)
 * 						@capDest 			- {@code String} Line destination
 */

{
	"total": 5,
	"InfoNodo": [
		{
			"nome_Az"			:"AtB",
			"codAzNodo"			:"16010012",
			"nomeNodo"			:"Torve",
			"descrNodo"			:"0012 (Torget                         )",
			"bitMaskProprieta"	:"",
			"codeMobile"		:"0012 (Torget                         )",
			"coordLon"			:"10.39307",
			"coordLat"			:"63.430638"
		}
	],
	"Orari": [
		{
			"codAzLinea"		:"5",
			"descrizioneLinea"	:"5",
			"orario"			:"21/01/2012 13:55",
			"orarioSched"		:"17/01/2012 13:51",
			"statoPrevisione"	:"Prev",
			"capDest"			:"Dragvoll                       "
		},
		{"codAzLinea":"5","descrizioneLinea":"5","orario":"21/01/2012 14:13","orarioSched":"17/01/2012 14:06","statoPrevisione":"Prev","capDest":"Dragvoll                       "},
		{"codAzLinea":"5","descrizioneLinea":"5","orario":"17/01/2012 14:21","orarioSched":"17/01/2012 14:21","statoPrevisione":"sched","capDest":"Dragvoll                       "},
		{"codAzLinea":"5","descrizioneLinea":"5","orario":"21/01/2012 14:37","orarioSched":"17/01/2012 14:36","statoPrevisione":"Prev","capDest":"Dragvoll                       "},
		{"codAzLinea":"5","descrizioneLinea":"5","orario":"17/01/2012 14:51","orarioSched":"17/01/2012 14:51","statoPrevisione":"sched","capDest":"Dragvoll                       "}
	]
}
?>