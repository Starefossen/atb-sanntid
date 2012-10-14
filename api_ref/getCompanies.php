<?php
/**
 * Get companies
 *
 * @url - http://st.atb.no/InfoTransit/innerStTp.aspx/getAziende
 *
 * @method post
 *
 * @header Content-Type	- application/json; charset=utf-8
 *
 */
 
 /**
 * @response total 		- Total companies in response
 * @response Aziende 	- Array of companies
 * 						@id 		- {@code integer} unique id
 * 						@Nome 		- {@code String} company name 
 * 						@TipoPerc 	- {@code String} company logo
 */

{
	"Aziende": [
		{
			"id"		:1,
			"Nome"		:"AtB",
			"TipoPerc"	:"icone/azienda_bus.gif"
		},
		{
			"id"		:2,
			"Nome"		:"NettBuss",
			"TipoPerc"	:"icone/azienda_bus.gif"
		}
	],
	"total":"2"
}
?>