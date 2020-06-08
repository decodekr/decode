<?php
	
	ini_set('memory_limit',-1);
	$sameWords=array();
	$omit=array('country','available_delivery_date','unit','quantity','unit_price','price','supplier');
	
	function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
	function checkMatching($keyword,$detail){
		
	}
	function samewords($word){
			if(strtoupper($word)=='SS' || strtoupper($word)=='SUS'|| strtoupper($word)=='STAINLESS STEEL'){
				return "WP304|A312-TP304|A240-Type 304|A182-F304|STS304,STS304W,STS304F|STS304TP|STS304|SUS304,SUS304W,SUS304F|SUS304TP|SUS304|3605-801|17440-X5 Cr Ni189|18% Cr-8% Ni Steel|WP304H|A312-TP304H|A240-Type 304H|A182-F304H|SUS304HTP|3605-811|18% Cr-8% Ni-(0.04-0.10)% C Steel|WP304L|A312-TP304L|A240-Type 304L|A182-F304L|STS304L,STS304LW,STS304LF|STS304LTP|STS304L|SUS304L,SUS304LW,SUS304LF|SUS304LTP|SUS304L|3605-811L|17440-X2 Cr Ni189|18% Ni-0.035% C Steel|WP309|A312-TP309|A240-Type 309S|STS309S,STS309SW,STS309SF|STS309TP|STS309S|SUS309S,SUS309SW,SUS309SF|SUS309STP|SUS309S|22% Cr-12% Ni Steel|WP310|A312-TP310|A240-Type 310S|A182-F310|STS310S,STS310SW,STS310SF|STS310TP|STS310S|SUS310S,SUS310SW,SUS310SF|SUS310STP|SUS310S|3605-805S|25% Cr-20% Ni Steel|WP316|A312-TP316|A240-Type 316|A182-F316|STS316,STS316W,STS316F|STS316TP|STS316|SUS316,SUS316W,SUS316F|SUS316TP|SUS316|3605-845|17440-X5 Cr Ni Mo1810|18% Cr-8% Ni-Mo Steel|WP316H|A312-TP316H|A240-Type 316H|A182-F316H|STS316H,STS316HF|STS316HTP|SUS316H,SUS316HF|SUS316HTP|3605-855|18% Cr-8% Ni-Mo(0.04-0.10)% C Steel|WP316L|A312-TP316L|A240-Type 316L|A182-F316L|STS316L,STS316LW,STS316LF|STS316LTP|STS316L|SUS316L,SUS316LW,SUS316LF|SUS316LTP|SUS316L|3605-845L|17440-X2 Cr Ni Mo1810|18% Cr-8% Ni-Mo-0.035% C Steel|WP317L|A312-TP317L|A240-Type 317L|A182-F317L|STS317L,STS317LW|STS317LTP|STS317L|SUS317L,SUS317LW|SUS317LTP|SUS317L|18% Cr-12% Ni-3.5% Mo-Low C|WP321|A312-TP321|A240-Type 321|A182-F321|STS321,STS321W,STS321F|STS321TP|STS321|SUS321,SUS321W,SUS321F|SUS321TP|SUS321|3605-822Ti|17440-X10 Cr Ni Ti189|18% Cr-8% Ni-Ti Steel|WP321H|A312-TP321H|A240-Type 321H|A182-F321H|SUS321HTP|3605-832Ti|18% Cr-8% Ni-Ti-(0.04-0.10)% C Steel|WP347|A312-TP347|A240-Type 347|A182-F347|STS347,STS347W,STS347F|STS347TP|STS347|SUS347,SUS347W,SUS347F|SUS347TP|SUS347|3605-822Nb|17440-X1 Cr Ni Nb189|18% Cr-8% Ni-Cb+Ta Steel|WP347H|A312-TP347H|A240-Type 347H|A182-F347H|STS347H,STS347HF|STS347HTP|SUS347H,SUS347HF|SUS347HTP|3605-832Nb|18% Cr-8% Ni-Cb+Ta(0.04-0.10)%C Steel";
			}
			if(strtoupper($word)=='LOW TEMPERATURE STEEL' || strtoupper($word)=='LTS'){
				return "WPL6|A333 & A334-6|A516-60|A350-LF2|PL39|STPL39|SLAL39|PL380(W)|STPL380|3603-Steel 27 LT 30|Carbon Steel|WPL3|A333 & A334-3|A203-D|A350-LF3|PL450(W)|STPL450|3603-Steel 503 LT 100|\"½% NI Steel|3\"|WPL9|A333 & A334-9|A203-A|A350-LF9|PL690(W)|STPL690|2% NI-1% CU Steel";
			}
			if(strtoupper($word)=='CS' || strtoupper($word)=='CARBON STEEL'){
				return "A120|A283-A|SPP|SPP|SB41|FSGP or SGP|SGP(STPY400)|SS400|1387-M|2440-ST33-1|A53-B|A284|PS38(W)|PS38|PT38(W)|PT38|SPPS38|SWS41B|PG370(W)|PS370(W)|PT370(W)|PT370|STPG370|SM41B|3602-ERW 23|1626-ST37|A53-B|A284|PS42(W)|PS42|PT42(W)|PT42|SPPS42|SWS41B|PG410(W)|PS410(W)|PT410(W)|PT410|STPG410|SM41B|3602-ERW 27|HT38|HT38(W)|SPHT38|SBB42|STPT370|SB42|3602-Steel 23|17175-ST35.8|WPB|A106-B|A515-60 or 70|A105|HT42|HT42(W)|SPHT42|SBB42|PS370|PT370(W)|STPT410|SB42|3602-Steel 27|17175-ST45.8|WPB|A106-B|A516-60 or 70|A516-60 or 70|PS410|PT410(W)|WPC|A106-C|A515-70|A105|HT49|HT49(W)|SPHT49|SBB49|STPT480|SB49|3602-Steel 35|WPC|A106-C|A516-70|A516-70|PS480|PT480(W)";
			}
			if(strtoupper($word)=='RF'||strtoupper($word)=='RAISED FACE'){
				return "RF|Raised Face";
			}
			if(strtoupper($word)=='FLAT FACE'||strtoupper($word)=='FF'){
				return "FF|FLAT FACE";
			}
			if(strtoupper($word)=='RTJ'||strtoupper($word)=='RING TYPE JOINT'){
				return "RTJ|RING TYPE JOINT";
			}

			if(strtoupper($word)=='WN'||strtoupper($word)=='WELDING NECK'){
				return "WN|WELDING NECK";
			}
			if(strtoupper($word)=='SO'||strtoupper($word)=='SLIP ON'){
				return "SO|SLIP ON";
			}
			if(strtoupper($word)=='LJ'||strtoupper($word)=='LAP JOINT'){
				return "LJ|LAP JOINT";
			}
			if(strtoupper($word)=='SW'||strtoupper($word)=='SOCKET WELD'){
				return "SW|SOCKET WELD";
			}
			if(strtoupper($word)=='BL'||strtoupper($word)=='BLIND'){
				return "BL|BLIND";
			}
			if(strtoupper($word)=='REDUCING WN'||strtoupper($word)=='REDUCING WELDING NECK'){
				return "REDUCING WN|REDUCING WELDING NECK";
			}


			if(strtoupper($word)=='A120'|strtoupper($word)=='A283-A'|strtoupper($word)=='SPP'|strtoupper($word)=='SPP'|strtoupper($word)=='SB41'|strtoupper($word)=='FSGP or SGP'|strtoupper($word)=='SGP(STPY400)'|strtoupper($word)=='SS400'|strtoupper($word)=='1387-M'|strtoupper($word)=='2440-ST33-1'){return 'A120|A283-A|SPP|SPP|SB41|FSGP or SGP|SGP(STPY400)|SS400|1387-M|2440-ST33-1';}if(strtoupper($word)=='A53-B'|strtoupper($word)=='A284'|strtoupper($word)=='PS38(W)|PS38|PT38(W)|PT38'|strtoupper($word)=='SPPS38'|strtoupper($word)=='SWS41B'|strtoupper($word)=='PG370(W)|PS370(W)|PT370(W)|PT370'|strtoupper($word)=='STPG370'|strtoupper($word)=='SM41B'|strtoupper($word)=='3602-ERW 23'|strtoupper($word)=='1626-ST37'){return 'A53-B|A284|PS38(W)|PS38|PT38(W)|PT38|SPPS38|SWS41B|PG370(W)|PS370(W)|PT370(W)|PT370|STPG370|SM41B|3602-ERW 23|1626-ST37';}if(strtoupper($word)==''|strtoupper($word)=='A53-B'|strtoupper($word)=='A284'|strtoupper($word)=='PS42(W)|PS42|PT42(W)|PT42'|strtoupper($word)=='SPPS42'|strtoupper($word)=='SWS41B'|strtoupper($word)=='PG410(W)|PS410(W)|PT410(W)|PT410'|strtoupper($word)=='STPG410'|strtoupper($word)=='SM41B'|strtoupper($word)=='3602-ERW 27'){return 'A53-B|A284|PS42(W)|PS42|PT42(W)|PT42|SPPS42|SWS41B|PG410(W)|PS410(W)|PT410(W)|PT410|STPG410|SM41B|3602-ERW 27';}if(strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)=='HT38|HT38(W)'|strtoupper($word)=='SPHT38'|strtoupper($word)=='SBB42'|strtoupper($word)==''|strtoupper($word)=='STPT370'|strtoupper($word)=='SB42'|strtoupper($word)=='3602-Steel 23'|strtoupper($word)=='17175-ST35.8'){return 'HT38|HT38(W)|SPHT38|SBB42|STPT370|SB42|3602-Steel 23|17175-ST35.8';}if(strtoupper($word)=='WPB'|strtoupper($word)=='A106-B'|strtoupper($word)=='A515-60 or 70'|strtoupper($word)=='A105'|strtoupper($word)=='HT42|HT42(W)'|strtoupper($word)=='SPHT42'|strtoupper($word)=='SBB42'|strtoupper($word)=='PS370|PT370(W)'|strtoupper($word)=='STPT410'|strtoupper($word)=='SB42'|strtoupper($word)=='3602-Steel 27'|strtoupper($word)=='17175-ST45.8'){return 'WPB|A106-B|A515-60 or 70|A105|HT42|HT42(W)|SPHT42|SBB42|PS370|PT370(W)|STPT410|SB42|3602-Steel 27|17175-ST45.8';}if(strtoupper($word)=='WPB'|strtoupper($word)=='A106-B'|strtoupper($word)=='A516-60 or 70'|strtoupper($word)=='A516-60 or 70'|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)=='PS410|PT410(W)'|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''){return 'WPB|A106-B|A516-60 or 70|A516-60 or 70||PS410|PT410(W)||';}if(strtoupper($word)=='WPC'|strtoupper($word)=='A106-C'|strtoupper($word)=='A515-70'|strtoupper($word)=='A105'|strtoupper($word)=='HT49|HT49(W)'|strtoupper($word)=='SPHT49'|strtoupper($word)=='SBB49'|strtoupper($word)==''|strtoupper($word)=='STPT480'|strtoupper($word)=='SB49'|strtoupper($word)=='3602-Steel 35'){return 'WPC|A106-C|A515-70|A105|HT49|HT49(W)|SPHT49|SBB49|STPT480|SB49|3602-Steel 35';}if(strtoupper($word)=='WPC'|strtoupper($word)=='A106-C'|strtoupper($word)=='A516-70'|strtoupper($word)=='A516-70'|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)=='PS480|PT480(W)'|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''){return 'WPC|A106-C|A516-70|A516-70||PS480|PT480(W)||';}if(strtoupper($word)=='WPL6'|strtoupper($word)=='A333 & A334-6'|strtoupper($word)=='A516-60'|strtoupper($word)=='A350-LF2'|strtoupper($word)=='PL39'|strtoupper($word)=='STPL39'|strtoupper($word)=='SLAL39'|strtoupper($word)=='PL380(W)'|strtoupper($word)=='STPL380'|strtoupper($word)=='3603-Steel 27 LT 30'){return 'WPL6|A333 & A334-6|A516-60|A350-LF2|PL39|STPL39|SLAL39|PL380(W)|STPL380|3603-Steel 27 LT 30';}if(strtoupper($word)=='WPL3'|strtoupper($word)=='A333 & A334-3'|strtoupper($word)=='A203-D'|strtoupper($word)=='A350-LF3'|strtoupper($word)=='PL450(W)'|strtoupper($word)=='STPL450'|strtoupper($word)=='3603-Steel 503 LT 100'){return 'WPL3|A333 & A334-3|A203-D|A350-LF3|PL450(W)|STPL450|3603-Steel 503 LT 100';}if(strtoupper($word)=='WPL9'|strtoupper($word)=='A333 & A334-9'|strtoupper($word)=='A203-A'|strtoupper($word)=='A350-LF9'|strtoupper($word)=='PL690(W)'|strtoupper($word)=='STPL690'){return 'WPL9|A333 & A334-9|A203-A|A350-LF9|PL690(W)|STPL690';}if(strtoupper($word)=='WP1'|strtoupper($word)=='A335-P1'|strtoupper($word)=='A204-B'|strtoupper($word)=='A182-F1'|strtoupper($word)=='PA12|FA12'|strtoupper($word)=='SPA12'|strtoupper($word)=='SBB46M'|strtoupper($word)=='PA12(W)|FA12'|strtoupper($word)=='STPA12'|strtoupper($word)=='17175-15 Mo3'){return 'WP1|A335-P1|A204-B|A182-F1|PA12|FA12|SPA12|SBB46M|PA12(W)|FA12|STPA12|17175-15 Mo3';}if(strtoupper($word)=='WP12'|strtoupper($word)=='A335-P12'|strtoupper($word)=='A387-12'|strtoupper($word)=='A182-F12'|strtoupper($word)=='PA22|FA22'|strtoupper($word)=='SPA22'|strtoupper($word)=='SCMV2'|strtoupper($word)=='PA22(W)|FA22'|strtoupper($word)=='STPA22'|strtoupper($word)=='3603-HF620'|strtoupper($word)=='17175-13 Cr Mo44'){return 'WP12|A335-P12|A387-12|A182-F12|PA22|FA22|SPA22|SCMV2|PA22(W)|FA22|STPA22|3603-HF620|17175-13 Cr Mo44';}if(strtoupper($word)=='WP11'|strtoupper($word)=='A335-P11'|strtoupper($word)=='A387-11'|strtoupper($word)=='A182-F11'|strtoupper($word)=='PA23|FA23'|strtoupper($word)=='SPA23'|strtoupper($word)=='SCMV3'|strtoupper($word)=='PA23(W)|FA23'|strtoupper($word)=='STPA23'|strtoupper($word)=='3603-HF621'){return 'WP11|A335-P11|A387-11|A182-F11|PA23|FA23|SPA23|SCMV3|PA23(W)|FA23|STPA23|3603-HF621';}if(strtoupper($word)=='WP22'|strtoupper($word)=='A335-P22'|strtoupper($word)=='A387-22'|strtoupper($word)=='A182-F22'|strtoupper($word)=='PA24|FA24'|strtoupper($word)=='SPA24'|strtoupper($word)=='SCMV4'|strtoupper($word)=='PA24(W)|FA24'|strtoupper($word)=='STPA24'|strtoupper($word)=='SCMV4'|strtoupper($word)=='3603-HF622|27'|strtoupper($word)=='17175-10 Cr Mo910'){return 'WP22|A335-P22|A387-22|A182-F22|PA24|FA24|SPA24|SCMV4|PA24(W)|FA24|STPA24|SCMV4|3603-HF622|27|17175-10 Cr Mo910';}if(strtoupper($word)=='WP5'|strtoupper($word)=='A335-P5'|strtoupper($word)=='A387-5'|strtoupper($word)=='A182-F5'|strtoupper($word)=='PA25|FA25'|strtoupper($word)=='SPA25'|strtoupper($word)=='SCMV6'|strtoupper($word)=='PA25(W)|FA25'|strtoupper($word)=='STPA25'|strtoupper($word)=='3603-HF625'){return 'WP5|A335-P5|A387-5|A182-F5|PA25|FA25|SPA25|SCMV6|PA25(W)|FA25|STPA25|3603-HF625';}if(strtoupper($word)=='WP7'|strtoupper($word)=='A335-P7'|strtoupper($word)=='A387-7'|strtoupper($word)=='A182-F7'){return 'WP7|A335-P7|A387-7|A182-F7';}if(strtoupper($word)=='WP9'|strtoupper($word)=='A335-P9'|strtoupper($word)=='A387-9'|strtoupper($word)=='A182-F9'|strtoupper($word)=='PA26(W)|FA26'|strtoupper($word)=='STPA26'){return 'WP9|A335-P9|A387-9|A182-F9|PA26(W)|FA26|STPA26';}if(strtoupper($word)=='WP91'|strtoupper($word)=='A335-P91'|strtoupper($word)=='A387-F91'|strtoupper($word)=='A182-F91'|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''|strtoupper($word)==''){return 'WP91|A335-P91|A387-F91|A182-F91|||';}if(strtoupper($word)=='WP304'|strtoupper($word)=='A312-TP304'|strtoupper($word)=='A240-Type 304'|strtoupper($word)=='A182-F304'|strtoupper($word)=='STS304|STS304W|STS304F'|strtoupper($word)=='STS304TP'|strtoupper($word)=='STS304'|strtoupper($word)=='SUS304|SUS304W|SUS304F'|strtoupper($word)=='SUS304TP'|strtoupper($word)=='SUS304'|strtoupper($word)=='3605-801'|strtoupper($word)=='17440-X5 Cr Ni189'){return 'WP304|A312-TP304|A240-Type 304|A182-F304|STS304|STS304W|STS304F|STS304TP|STS304|SUS304|SUS304W|SUS304F|SUS304TP|SUS304|3605-801|17440-X5 Cr Ni189';}if(strtoupper($word)=='WP304H'|strtoupper($word)=='A312-TP304H'|strtoupper($word)=='A240-Type 304H'|strtoupper($word)=='A182-F304H'|strtoupper($word)=='SUS304HTP'|strtoupper($word)=='3605-811'){return 'WP304H|A312-TP304H|A240-Type 304H|A182-F304H|SUS304HTP|3605-811';}if(strtoupper($word)=='WP304L'|strtoupper($word)=='A312-TP304L'|strtoupper($word)=='A240-Type 304L'|strtoupper($word)=='A182-F304L'|strtoupper($word)=='STS304L|STS304LW|STS304LF'|strtoupper($word)=='STS304LTP'|strtoupper($word)=='STS304L'|strtoupper($word)=='SUS304L|SUS304LW|SUS304LF'|strtoupper($word)=='SUS304LTP'|strtoupper($word)=='SUS304L'|strtoupper($word)=='3605-811L'|strtoupper($word)=='17440-X2 Cr Ni189'){return 'WP304L|A312-TP304L|A240-Type 304L|A182-F304L|STS304L|STS304LW|STS304LF|STS304LTP|STS304L|SUS304L|SUS304LW|SUS304LF|SUS304LTP|SUS304L|3605-811L|17440-X2 Cr Ni189';}if(strtoupper($word)=='WP309'|strtoupper($word)=='A312-TP309'|strtoupper($word)=='A240-Type 309S'|strtoupper($word)=='STS309S|STS309SW|STS309SF'|strtoupper($word)=='STS309TP'|strtoupper($word)=='STS309S'|strtoupper($word)=='SUS309S|SUS309SW|SUS309SF'|strtoupper($word)=='SUS309STP'|strtoupper($word)=='SUS309S'){return 'WP309|A312-TP309|A240-Type 309S|STS309S|STS309SW|STS309SF|STS309TP|STS309S|SUS309S|SUS309SW|SUS309SF|SUS309STP|SUS309S';}if(strtoupper($word)=='WP310'|strtoupper($word)=='A312-TP310'|strtoupper($word)=='A240-Type 310S'|strtoupper($word)=='A182-F310'|strtoupper($word)=='STS310S|STS310SW|STS310SF'|strtoupper($word)=='STS310TP'|strtoupper($word)=='STS310S'|strtoupper($word)=='SUS310S|SUS310SW|SUS310SF'|strtoupper($word)=='SUS310STP'|strtoupper($word)=='SUS310S'|strtoupper($word)=='3605-805S'){return 'WP310|A312-TP310|A240-Type 310S|A182-F310|STS310S|STS310SW|STS310SF|STS310TP|STS310S|SUS310S|SUS310SW|SUS310SF|SUS310STP|SUS310S|3605-805S';}if(strtoupper($word)=='WP316'|strtoupper($word)=='A312-TP316'|strtoupper($word)=='A240-Type 316'|strtoupper($word)=='A182-F316'|strtoupper($word)=='STS316|STS316W|STS316F'|strtoupper($word)=='STS316TP'|strtoupper($word)=='STS316'|strtoupper($word)=='SUS316|SUS316W|SUS316F'|strtoupper($word)=='SUS316TP'|strtoupper($word)=='SUS316'|strtoupper($word)=='3605-845'|strtoupper($word)=='17440-X5 Cr Ni Mo1810'){return 'WP316|A312-TP316|A240-Type 316|A182-F316|STS316|STS316W|STS316F|STS316TP|STS316|SUS316|SUS316W|SUS316F|SUS316TP|SUS316|3605-845|17440-X5 Cr Ni Mo1810';}if(strtoupper($word)=='WP316H'|strtoupper($word)=='A312-TP316H'|strtoupper($word)=='A240-Type 316H'|strtoupper($word)=='A182-F316H'|strtoupper($word)=='STS316H|STS316HF'|strtoupper($word)=='STS316HTP'|strtoupper($word)=='SUS316H|SUS316HF'|strtoupper($word)=='SUS316HTP'|strtoupper($word)=='3605-855'){return 'WP316H|A312-TP316H|A240-Type 316H|A182-F316H|STS316H|STS316HF|STS316HTP|SUS316H|SUS316HF|SUS316HTP|3605-855';}if(strtoupper($word)=='WP316L'|strtoupper($word)=='A312-TP316L'|strtoupper($word)=='A240-Type 316L'|strtoupper($word)=='A182-F316L'|strtoupper($word)=='STS316L|STS316LW|STS316LF'|strtoupper($word)=='STS316LTP'|strtoupper($word)=='STS316L'|strtoupper($word)=='SUS316L|SUS316LW|SUS316LF'|strtoupper($word)=='SUS316LTP'|strtoupper($word)=='SUS316L'|strtoupper($word)=='3605-845L'|strtoupper($word)=='17440-X2 Cr Ni Mo1810'){return 'WP316L|A312-TP316L|A240-Type 316L|A182-F316L|STS316L|STS316LW|STS316LF|STS316LTP|STS316L|SUS316L|SUS316LW|SUS316LF|SUS316LTP|SUS316L|3605-845L|17440-X2 Cr Ni Mo1810';}if(strtoupper($word)=='WP317L'|strtoupper($word)=='A312-TP317L'|strtoupper($word)=='A240-Type 317L'|strtoupper($word)=='A182-F317L'|strtoupper($word)=='STS317L|STS317LW'|strtoupper($word)=='STS317LTP'|strtoupper($word)=='STS317L'|strtoupper($word)=='SUS317L|SUS317LW'|strtoupper($word)=='SUS317LTP'|strtoupper($word)=='SUS317L'){return 'WP317L|A312-TP317L|A240-Type 317L|A182-F317L|STS317L|STS317LW|STS317LTP|STS317L|SUS317L|SUS317LW|SUS317LTP|SUS317L';}if(strtoupper($word)=='WP321'|strtoupper($word)=='A312-TP321'|strtoupper($word)=='A240-Type 321'|strtoupper($word)=='A182-F321'|strtoupper($word)=='STS321|STS321W|STS321F'|strtoupper($word)=='STS321TP'|strtoupper($word)=='STS321'|strtoupper($word)=='SUS321|SUS321W|SUS321F'|strtoupper($word)=='SUS321TP'|strtoupper($word)=='SUS321'|strtoupper($word)=='3605-822Ti'|strtoupper($word)=='17440-X10 Cr Ni Ti189'){return 'WP321|A312-TP321|A240-Type 321|A182-F321|STS321|STS321W|STS321F|STS321TP|STS321|SUS321|SUS321W|SUS321F|SUS321TP|SUS321|3605-822Ti|17440-X10 Cr Ni Ti189';}if(strtoupper($word)=='WP321H'|strtoupper($word)=='A312-TP321H'|strtoupper($word)=='A240-Type 321H'|strtoupper($word)=='A182-F321H'|strtoupper($word)=='SUS321HTP'|strtoupper($word)=='3605-832Ti'){return 'WP321H|A312-TP321H|A240-Type 321H|A182-F321H|SUS321HTP|3605-832Ti';}if(strtoupper($word)=='WP347'|strtoupper($word)=='A312-TP347'|strtoupper($word)=='A240-Type 347'|strtoupper($word)=='A182-F347'|strtoupper($word)=='STS347|STS347W|STS347F'|strtoupper($word)=='STS347TP'|strtoupper($word)=='STS347'|strtoupper($word)=='SUS347|SUS347W|SUS347F'|strtoupper($word)=='SUS347TP'|strtoupper($word)=='SUS347'|strtoupper($word)=='3605-822Nb'|strtoupper($word)=='17440-X1 Cr Ni Nb189'){return 'WP347|A312-TP347|A240-Type 347|A182-F347|STS347|STS347W|STS347F|STS347TP|STS347|SUS347|SUS347W|SUS347F|SUS347TP|SUS347|3605-822Nb|17440-X1 Cr Ni Nb189';}if(strtoupper($word)=='WP347H'|strtoupper($word)=='A312-TP347H'|strtoupper($word)=='A240-Type 347H'|strtoupper($word)=='A182-F347H'|strtoupper($word)=='STS347H|STS347HF'|strtoupper($word)=='STS347HTP'|strtoupper($word)=='SUS347H|SUS347HF'|strtoupper($word)=='SUS347HTP'|strtoupper($word)=='3605-832Nb'){return 'WP347H|A312-TP347H|A240-Type 347H|A182-F347H|STS347H|STS347HF|STS347HTP|SUS347H|SUS347HF|SUS347HTP|3605-832Nb';}if(strtoupper($word)==''){return '';}
	

		return $word;


	}
if($param['mode']=='product_list'){

	if($param['category']==''){
		exit;
	}
	$where=  '';;
	$select = '';
	
	
	//키워드 보정
	
	
	
	if($param['keyword']){
		$where.=' (';

		//컴마와 공백으로 쪼갠다.

		$param['keyword'] =  str_replace('\"','inch',$param['keyword']);
		$param['keyword'] =  str_replace('인치','inch',$param['keyword']);
		$param['keyword'] =  str_replace('#','lb',$param['keyword']);
		$param['keyword'] =  str_replace('pound','lb',$param['keyword']);
		$param['keyword'] = multiexplode(array(','),$param['keyword']);
		$param['keyword']=array_filter($param['keyword']);
		
		$keywords='';
		foreach($param['keyword'] as $keyword){
			if($keywords!=''){
				$keywords.=',';
			}
			//$keywords.=samewords($keyword);
			$keyword=trim($keyword);
			if(strpos($keyword,'inch')!==FALSE){
				$keyword = '"'.$keyword.'';
				
			}
			$keywords.=trim($keyword);
			
			
			
		}		

	

		$keywords = explode(',',$keywords);
		

		foreach($keywords as $index=>$keyword){
			if(trim($keyword)==''){
				continue;
			}
			if($index!=0){
				
				$select.=' + ';
			}
			if(strpos(sameWords($keyword),'|')!==FALSE){
				$samekeywords=explode('|',sameWords($keyword));
				$cond='';
				foreach($samekeywords as $keyword){
					array_push($sameWords,$keyword);
					if($cond!=''){
						$cond.=' OR ';
					
					}
					$cond.="details like '%".($keyword)."%'";
				}
				if($index!=0){
					$where.=' OR ';
				
				}
				$where.='('.$cond.')';

			}
			else{
				if($index!=0){
					$where.=' OR ';
				
				}
				
				if(strpos($keyword,'inch')!==FALSE){
					//$keyword = '"'.$keyword.'"';
				}
				$where.="details like '%".($keyword)."%'";
				$cond="details like '%".($keyword)."%'";
			}
		
			$select.="case when ".$cond." then 1 else 0 end";
		}
			$where.=')';
	}






//echo $where;
		/*
	select *
      ,((case when details like '%KTT%' then 1 else 0 end) +
      (case when details like '%삼한%' then 1 else 0 end) +
      (case when details like '%PIPE%' then 1 else 0 end) ) as priority
  from product_lists
 where details like '%KTT%'
    or details like '%삼한%'
    or details like '%PIPE%'
 order by priority desc
*/
	$keywordLen = count($param['keyword']);

	if($param['category']){
		if($where!=''){
			$where.=' AND ';
		}
		$where.='category like "%'.$param['category'].'%"';
	}
/*	if($param['details']){
		foreach($param['details'] as $detail){
			if($where!=''){
				$where.=' OR ';
			}
			$where.='details like "%'.$detail.'%"';
		}
	}*/
	$param['product_type'] =$param['category'];
	
	if($select!=''){
		$order='match_rate desc';
	$select = '*,('.$select.')/'.$keywordLen.' AS match_rate';
	}
	else{
	$order='';
	}




$products=pageListSelect('product_lists',$where,$order,10,10,$param['page'],'$page',$select);





/*
if($keywordLen>0&&$param['keyword']!=''){
foreach($products['list'] as $index=>$product){
	$match=0;
	foreach($param['keyword'] as $keyword){

		if(trim($keyword)!=''){

			if(strpos($product['details'],$keyword)!==FALSE |strpos($product['details'],strtolower($keyword))!==FALSE|strpos($product['details'],strtoupper($keyword))!==FALSE){
				$match++;
			}
		}
	}

	$matchRate = $match/$keywordLen;
	$products['list'][$index]['match_rate'] = $matchRate;
}

$matchRates=array();

foreach ($products['list'] as $key => $product)
{
    $matchRates[$key] = $product['match_rate'];
}
array_multisort($matchRates, SORT_DESC, $products['list']);
}
*/



if($keywords[0]!=''){

$strongKeywords=array();
$strongKeywordsSame=array();

foreach($keywords as $keywordIndex=>$keyword){
	if(strpos($keyword,'inch')!==FALSE){
	$strongKeywords[$keywordIndex] = '"<strong style=\'color:#EE4123\'>'.strtoupper(str_replace('"','',$keyword)).'</strong>';
	}
	else{
	$strongKeywords[$keywordIndex] = '<strong style=\'color:#EE4123\'>'.strtoupper($keyword).'</strong>';
	}
	
}

foreach($sameWords as $keywordIndex=>$keyword){

	$strongKeywordsSame[$keywordIndex] = '<strong style=\'color:#2c4fa3\'>'.$keyword.'</strong>';
}

foreach($products['list'] as $productIndex=>$product){

	$products['list'][$productIndex]['details']=str_ireplace($keywords,$strongKeywords,$products['list'][$productIndex]['details']);
}



foreach($products['list'] as $productIndex=>$product){
	$products['list'][$productIndex]['details']=str_ireplace($sameWords,$strongKeywordsSame,$products['list'][$productIndex]['details']);
}


}


//print_x($products['list']);




?>









				<?php
		if($param['category']=='pipe'){


					if($products['length']>0){
				$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
                <thead>
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
					<th>category</th>
					<th>seamless/welded</th>
					<th>welding_type</th>
					<th>material_grade</th>
					<th>zinc/galva</th>
					<th>size1</th>
					<th>sch1</th>
					<th>end</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                 <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					
					if($detail==''){
						echo '<td  data-category="'.$title.'">-</td>';
					}else{

				?>
				<td data-category="<?=$title?>"><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}
				}
			?>


				<?php
		if($param['category']=='valve'){
						if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
            <table class="search-list-table" >
              <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
                                     	   <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>item</th>
					<th>forged/casting</th>
					<th>type</th>
					<th>bore</th>
					<th>operating_type</th>
					<th>material_grade</th>
					<th>trim_material</th>
					<th>seat_material</th>
					<th>size1</th>
					<th>pressure_rating</th>
					<th>end</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>drawing_y/n</th>
					<th>pressure_test_report_y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td data-cate="'.$title.'">-</td>';
					}else{

				?>
				<td data-cate="<?=$title?>"><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
				}
			?>




						<?php
		if($param['category']=='fitting'){
								if($products['length']>0){
							$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
             <table class="search-list-table" >
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>item</th>
					<th>forged/pipe</th>
					<th>type</th>
					<th>material</th>
					<th>nace_y/n</th>
					<th>size1</th>
					<th>size2</th>
					<th>size3</th>
					<th>schedule_1</th>
					<th>schedule_2</th>
					<th>pressure__rating</th>
					<th>end1</th>
					<th>end2</th>
					<th>end3</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td>-</td>';
					}else{

				?>
				<td><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
						}
			?>

				
						<?php

		if($param['category']=='flange'){
								if($products['length']>0){
									$detailTitle=json_decode( $products['list'][0]['details'],true);
	?>
               <table class="search-list-table" >
               <thead>
                <tr>

	

                    <th><input type="checkbox" id="check_all"></th>
					  <?php if($param['keyword']){?>
                    <th>Matching</th>             
					<?php
					}	
					?>
                                     	  <th>category</th>
					<th>type1</th>
					<th>reducing_y/n</th>
					<th>material</th>
					<th>size1</th>
					<th>size2</th>
					<th>sch1</th>
					<th>pressure</th>
					<th>end1</th>
					<th>code</th>
					<th>scratch_y/n</th>
					<th>dent_y/n</th>
					<th>rust_y/n</th>
					<th>heat_no._and_product_certi._y/n</th>
					<th>raw_material_certi._y/n</th>
					<th>manufactured_year</th>
					<th>manufacturer</th>
					                    <!-- <th>TYPE</th>
                    <th>SIZE</th>
                    <th>MATERIAL GRADE</th>
                    
                    <th>MANUFACTURER</th> -->
           
                </tr>
                </thead>
                <tbody>
				<?php
					foreach($products['list'] as $product){
						$product['details']=json_decode( $product['details'],true);
						//print_x($product['details']);
						$product['details']['package_type']=null;
						$product['details']['delivery_type']=null;
						$product['details']['Submit']=null;
					//	$product['details']['product_type']=null;
						$product['details']['has_data']=null;
					
				?>
					   <tr>
                    <th scope="row"><input type="checkbox" name="no[]" value="<?=$product['no']?>"></th>
                    <?php if($param['keyword']){?> <th><?=round(($product['match_rate']*100))?>%</th> <?php } ?>
                   <?php
					foreach($product['details'] as $title=>$detail){
					if($title=='country'){
						break;
					}
					if(in_array($title,$omit)){
						continue;
					}
					if($detail==''){
						echo '<td data-cate="'.$title.'">-</td>';
					}else{

				?>
				<td><?=$detail?></td>
					<?php
				}
				}
				?>
				 <!-- 
                    <td><?=$product['details']['pipe_type']?></td>
                    <td><?=$product['details']['size']?></td>
                    <td><?=$product['details']['material_grade']?></td>
                    <td><?=$product['details']['manufacturer']?></td> -->

                    <!-- <td><?=$product['details']['material']?></td> -->
     
                 
                </tr>
				<?php
			}	
				?>
              
                </tbody>
            </table>
				<?php
	}else{
				
				echo '<div id="no-result">검색 결과가 없습니다.</div>';
				}	
						}
			?>
				 <div id="pagination_wrap">
					<div class="pagination">
						<?=$products['pagination']?>
				</div>

				</div>
				
				
			
	<?php
				exit;
}
	include'views/header.html';
?>
<style type="text/css">

.search-list-table thead th, .search-list-table tbody td{
	width: 80px;;
}

#wrapper {
opacity:0;
	position: absolute;
	z-index: 1;
	top: 65px;
	bottom: 48px;
	left: 0;
	height:650px;
	width: 100%;

	overflow: hidden;
}

#scroller {
	position: absolute;
	z-index: 1;
	-webkit-tap-highlight-color: rgba(0,0,0,0);
	width: 2700px;
	height: 100%;

	-webkit-transform: translateZ(0);
	-moz-transform: translateZ(0);
	-ms-transform: translateZ(0);
	-o-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-text-size-adjust: none;
	-moz-text-size-adjust: none;
	-ms-text-size-adjust: none;
	-o-text-size-adjust: none;
	text-size-adjust: none;
}



</style>
<style>
#search_wrap{
padding: 40px 0;
}
	#search_left{
	float: left;
	position: relative;

	width: 330px;
}
	#search_right{
	width: 900px;
	height: 800px;
	float: right;
	margin-left: 30px;
}
.block-search{
	margin: 10px;
	width: auto;
}
.form-search .form-control{
border: 0;
width: 786px;
}
.block-search .block-content{
text-align: left;
}
.filter-options .filter-options-title{
	
}
.filter-options-content .label{
margin-right: 10px;
}
</style>
<main class="site-main site-login">
<div class="container" id="search_wrap">
<div id="search_left">




	<div class="filter-options">
		  <div class="block-content">
			<div class="filter-options-item filter-categori categories">
                  <div class="filter-options-title">품목</div>
					<div class="filter-option-contents">
						<label class="inline">
							<input type="checkbox" name="product_type" value="pipe" data-next="pipe" data-type="pipe"  <?=attr($param['category']=='pipe','checked')?> >
							<span class="input"></span> Pipe
                         </label>&nbsp;&nbsp;
						 <label class="inline">
							<input type="checkbox" name="product_type" value="valve" data-next="valve" data-type="valve" <?=attr($param['category']=='valve','checked')?>>
							<span class="input"></span> Valve
                         </label>&nbsp;&nbsp;
						 <label class="inline">
							<input type="checkbox" name="product_type" value="fitting" data-next="fitting" data-type="fitting"  <?=attr($param['category']=='fitting','checked')?>>
							<span class="input"></span> Fitting
                         </label>
						 <label class="inline">
							<input type="checkbox" name="product_type" value="flange" data-next="flange" data-type="flange"  <?=attr($param['category']=='flange','checked')?>>
							<span class="input"></span> FLANGE
                         </label>

					</div>
			</div>
		  </div>
	</div>



	<style>
	#search_layer{
		display: none;
		position: absolute;z-index: 10000;
		top: 0;
		left: 0;
		width: 330px;
		border-radius:10px;
		border: 1px solid #ddd;
			height: 440px;
			background: #fff;
	}
	#search_layer h3{
		position: relative;
		text-indent: 10px;
		line-height: 40px;
		font-size:20px;
		margin-bottom: 0;
		font-weight: bold;
	}
	#search_layer h3 .close_button{
		line-height: 25px;
		width: 25px;
		height: 25px;
		position: absolute;
		top: 10px;
		right: 10px;
		border: 1px solid #bdbfc3;
		border-radius:2px;
		text-align: center;
		font-family: arial;
		color: #bdbfc3;
		font-weight: normal;
		text-indent: 0;
	}
	#search_result{
		height: 330px;
		overflow-y: scroll;
	}
	#search_layer_input{
		background: #232a34;
		position: relative;
		padding: 11px 30px;
	}
	#search_layer_input input{
		width: 100%;
		height: 32px;
		padding: 10px 2px;
		border-radius:4px;
		border: 1px solid #5a626d;
		box-sizing:border-box;
		background: transparent;
	}
	#search_layer_input i{
		position: absolute;
		top: 17px;
		right: 40px;
	}
	#search_result li{
		list-style: none;
		line-height: 33px;
		padding: 5px;
		margin-bottom: 0;
		border-bottom: 1px solid #ddd;
	}
	.search-list-table thead th,.search-list-table tbody td{
	line-height: 17px;
	font-size:12px;
	}
	.search-list-table tbody td{
font-size:12px;
letter-spacing:-1px;
	}
	.search-list-table tbody tr{
	display: none;
	}
</style>
<div id="search_layer">
	<h3>
	<span class="title" id="product_title"></span>
		선택
		<a href="" class="close_button">X</a>
	</h3>
	<div id="search_layer_input">
			<input type="text" placeholder="검색어 입력"><i class=" fa fa-search"></i>

	</div>
	<ul id="search_result">
		

	</ul>
	
</div>



</div><!-- AND LEFT-->


	<div id="search_right">
	<div class="block-search" >
					<div class="block-content">
						
						<div class="form-search">
							
								<div class="box-group">
									<input type="text" name="keyword" id="search_keyword_input" placeholder="카테고리를 선택하고 검색어를 ,(컴마)로 구분하여 입력해주세요." class="form-control" value="<?=htmlspecialchars($_GET['keyword'])?>">
									<button class="btn btn-search" type="button" id="search_button"><span class="fa fa-search"></span></button>
								</div>
							
						</div>
					</div>
				</div>
				<form id="product_list_form" method="post" action="/user/estimate_cart">
					
<style>
	#product_list_form{
	position: relative;
}
#right_button{
	position: absolute;
	top: 0;
	right: 0;
	width: 30px;
	height:360px;
	text-align: center;
	line-height: 360px;
	background: rgba(0,0,0,0.6);
	color: #fff;
}
.slide_buttons{
display: none;
}
#left_button{
	position: absolute;
	top: 360px;;
	right: 0;
	width: 30px;
	height: 360px;
	text-align: center;
	border-top: 1px solid #fff;
	
	line-height: 360px;
	background: rgba(0,0,0,0.6);
	color: #fff;
}
</style>
			<!-- <a href="" id="right_button" class="slide_buttons">
				<i class="fa fa-arrow-right"></i>

			</a>
			<a href="" id="left_button" class="slide_buttons">
					<i class="fa fa-arrow-left"></i>

			</a> -->
			<div id="no-result">품목을 선택해주세요.</div>
			<div id="wrapper">
	<div id="scroller">
		  <div class="search-list-table_wrap" >
				
		  </div>
		  </div>
		 </div>
		  <div class="pagination">
						
				</div>
		  	</form>
		         <div class="clearfix">
		
                <a href="/user/estimate_cart" id="to_estimate_cart_button" class="float-right btn btn-light btn-xs waves-effect waves-light btn-list-select">선택한 제품 견적 바구니에 담기</a>
            </div>

	</div>   
	
	<script>
	var scroll=0;
		$('#right_button').click(function(){
		var cur=$('.search-list-table_wrap').scrollLeft();
		$('.search-list-table_wrap').scrollLeft(cur+100);
		return false;
	});
		$('#left_button').click(function(){
		var cur=$('.search-list-table_wrap').scrollLeft();
		$('.search-list-table_wrap').scrollLeft(cur-300);
		return false;
	});

	</script>





</div>

 </main>

<style>

#loading{
	position: fixed;
	z-index: 9099;
	top: 50%;
	left: 50%;
	margin-left: -100px;
	margin-top: -100px;
}
	/*.search-list-table_wrap{
	overflow-x: hidden;
	min-height:760px;
}*/

</style>
<script>

	var currentSelect = 0;
	var serach  = [];
		$(document).on('click','#product_list_search_form input',function(){
	$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
});

$('#search_keyword_input').on('change keyup paste',function(){
		//$('#search_left .filter-options:gt(0)').remove()
		$('.detail_category').remove();
});
	$(document).on('click','.filter-option-contents input',function(){
		//	$('.filter-options:gt(0).filter-options').remove()
		$('#search_keyword_input').val('')
		
			currentSelect=0;
		search(this);

	
		
	

			//$(this).parent().parent().parent().nextAll('.filter-options').remove();

	
	});


jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};


	$(document).on('click','.search_button',function(){
		currentSelect  =$(this).closest('.filter-options').index();
		$('#search_layer').slideDown().find('#search_result').html($(this).next().html());
		return false;

	});
	$(document).on('click','#search_result input',function(){
		var value  = $(this).val();
		if($('#search_keyword_input').val()!=''){
			value= $('#search_keyword_input').val()+','+value;
		}
		
		$('#search_keyword_input').val(value)
		search(this);
	
		$(this).parent().parent().siblings().find('input[type="checkbox"]').prop({checked:false});
		

	});
	$('.close_button').click(function(){
		$('#search_layer').slideUp();
		return false;
	});
	$('#search_layer_input input').keyup(function(){
		var keyword = $(this).val();
		$('#search_result li').hide();
		$('#search_result li:contains("'+keyword.toUpperCase()+'")').show();
	});

	function search($elem){
		
		var categoryGroup =  $($elem).data('next');
		$('#product_title').text(categoryGroup)
		var type= $($elem).data('type');
		var $this = $($elem);

		var $parent = $('.filter-options').eq(currentSelect);
		var $check= $($elem).prop('checked');

		if($($elem).attr('name')=='product_type'){
			$('.chosen-single').text($($elem).parent().text())
				
				$('#search_category').val($($elem).val())
		}
		

		$('.filter-options').eq(currentSelect).find('.filter-options-content .label').text($($elem).val());
		
		$parent.nextAll('.filter-options').remove();

	
		
		if(categoryGroup&&$check){//다음그룹이 있고 체크됬을때만
		//if($(this).parent().find('ul').size()==0){
			$($elem).parent().siblings().find('input').prop({checked:false});
			postRequest({
				url : '/product/add',
				data : {category_group:categoryGroup,has_data : 'next_category',type:type},
				success : function($data){
					
					var  $template=  [];
					for(var iu=0;iu<$data.list.length;iu++){
						if($data.list[iu].additional_info==''){
							additional = ''
						}
						else{
							additional = '('+$data.list[iu].additional_info+')'
						}
						$template.push('<li><label class="inline"><input type="checkbox" name="'+$data.list[iu].category_group+'" value="'+$data.list[iu].keyword.replace('"','&quot;')+'" data-next="'+$data.list[iu].next_category_group+'" data-type="'+$data.list[iu].product_type+'"><span class="input"></span>'+$data.list[iu].name+additional+' </label></li>');
					}
					if($data.length>0){
						$parent.after(' <div class="filter-options"><div class="block-content"><div class="filter-options-item filter-categori categories"><div class="filter-options-title">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+'</div><div class="filter-options-content"><span class="label label-default detail_category"></span><a href="" class="btn btn-default search_button">'+$data.list[0].category_group.replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ').replace('_',' ')+' 선택</a><ul style="display:none;" >'+$template.join('')+'</ul></div></div></div></div>')
					}
				$('#search_layer').slideUp()
				//	$('#search_layer').slideDown().find('#search_result').html($template.join(''));
					
				$('.filter-options').eq(currentSelect).next().find('.search_button').click();
				}


			});
		}
		else{
			$('#search_layer').slideUp()
		}

	var keyword =$('#search_keyword_input').val();
		getList(1,keyword);
	}



	function getList($page,$keyword){
var category = $('[name="product_type"]:checked').val()

	
openLoading();


			var details= [];


			$('.detail_category').each(function(){
			
				details.push($(this).text());
			});
			
			

				if(category==undefined){
					$('.slide_buttons').hide();
				}
				else{
					$('.slide_buttons').show();
				}

			
			
			postRequest({
				url : '/product/list',
				data:  {mode : 'product_list',category: category,details:details,page:$page,keyword:$keyword},
				dataType:'HTML',
				success : function($data){
						closeLoading()
					if($data!=''){
					$('#wrapper').css({opacity:1});
					$('#no-result').hide();
					}
					else{
							$('#no-result').show();
						$('#wrapper').css({opacity:0});
				}
					$('.search-list-table_wrap').html($data)
					if($('#no-result').size()>0){
					$('.slide_buttons').hide();
				}
					
				 itemTotal = $('.search-list-table tbody tr').size()
					//paginationLoad(itemTotal,1,15,10);
					$('.search-list-table tbody tr:lt(15)').show();
				}

			})
	}

/*
function paginationLoad($total,$page,$itemNum,$pageNum) {
	var template = '';
	var totalPage = Math.ceil($total / $itemNum);
	var firstPage = Math.floor(($page - 1) / $pageNum) * $pageNum + 1;
	if(firstPage < 1) firstPage = 1;
	var lastPage = firstPage - 1 + $pageNum;
	if(lastPage > totalPage) lastPage = totalPage;
	if(totalPage > $pageNum) {
		template+='<li><a href="" data-page="1">&lt;&lt;</a></li>'
	}
	if($page > $pageNum) {
		var prevPageGroup = firstPage-1;
		template+='<li><a href="" data-page="'+prevPageGroup+'">&lt;</a></li>'
	}
	for(var iu=firstPage;iu<=lastPage;iu++) {
		if(iu==$page){
			active='class="active" ';
		} else {
				active='';
		}
		template+='<li  '+active+'><a href="" data-page="'+iu+'">'+iu+'</a></li>';
	}
	if(lastPage < totalPage) {
		var nextPageGroup = lastPage + 1;
		template+='<li><a href="" data-page="'+nextPageGroup+'">&gt;</a></li>'
	}
	if(totalPage > $pageNum) {
		template+='<li><a href=""  data-page="'+totalPage+'">&gt;&gt;</a></li>'
	}
	$('.pagination').html(template);
}
*/

function openLoading(){
	$('#loading,#fog').show()
	
	}


function closeLoading(){
	$('#loading,#fog').hide()
	
	}



var keyword =$('#search_keyword_input').val();
		getList(1,keyword);

$('.btn-search').click(function(){
	if($('[name="product_type"]:checked').size()==0){
		alert('품목을 선택해주세요.');	
		return false;
	
	}
	var keyword =$('#search_keyword_input').val();
getList(1,keyword);

});

var searchRun=null;
$('#search_keyword_input').on('keyup change paste',function($event){
	var keyword =$('#search_keyword_input').val();
	clearTimeout(searchRun);
	
	searchRun=setTimeout(function(){
		
		getList(1,keyword)

		
	},850);
})
$(document).on('click','.pagination a',function(){
		var keyword =$('#search_keyword_input').val();
var page = $(this).attr('href');

//$('.search-list-table tbody tr').hide();
//paginationLoad(itemTotal,page,15,10);
//$('.search-list-table tbody tr').slice((page-1)*15,page*15).show()
getList(page,keyword);
return false;
});

	$(window).scroll(function(){
		var top = $(this).scrollTop();

		$('#search_layer').css({top : top})
	});

		$('#to_estimate_cart_button').click(function(){

				if('<?=$_SESSION['login']?>'==''){

			Swal.fire({
  title: '<strong>로그인 후 이용해주세요.</strong>',
  icon: 'warning',
  html:
    '로그인 화면으로 이동하시겠습니까?.',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
  if (result.value) {
 	location.href='/user/login';
  }
})

	return false;
		}


		var checked=[];
		$('.search-list-table tbody input[type="checkbox"]:checked').each(function(){
			
			checked.push($(this).val());
			
		});
	if(checked==''){
			Swal.fire({
		  title: '<strong>견적 바구니에 담을 상품을 선택해주세요..</strong>',
		  icon: 'warning',
		 
		  showCloseButton: true,

		  focusConfirm: false,
		  confirmButtonText:
			'<a href="#"  style="color:white;">확인</a>',
		  confirmButtonAriaLabel: 'Thumbs up, great!',
		 
		  cancelButtonAriaLabel: 'Thumbs down'
		})
			return false;
	}
	$.ajax({
		url : '/user/estimate_cart',
		data :  {no : checked},
		type:'POST',
		dataType:'HTML',
		success : function($data){
			
		}
		
	})

		$('.search-list-table input[type="checkbox"]').prop({checked:false})
	
Swal.fire({
  title: '<strong>견적 바구니로 이동하시겠습니까?</strong>',
  icon: 'info',
  html:
    '선택한 제품을 견적 바구니에 담았습니다.',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    '<a href="#"  style="color:white;">확인</a>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '취소',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {
  if (result.value) {
 	$('#product_list_form').submit();
  }
})




	return false;
});
$(document).on('click','#check_all',function(){
	var checked = $(this).prop('checked')
		$('#product_list_form input[type="checkbox"]').prop({checked:checked});
});
</script>

<script src="/scripts/iscroll.js"></script>
<script type="text/javascript">

var myScroll;


	myScroll = new IScroll('#wrapper', {scrollbars: true, scrollX: true, scrollY: false, mouseWheel: true });



</script>



<div id="loading" style="display:none;">
	<img src="/images/smalllogo.png" alt="">

</div>
	<?php

	include'views/footer.html';
?>