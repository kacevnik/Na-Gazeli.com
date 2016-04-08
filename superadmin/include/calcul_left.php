						<noindex>
						<div class="pad2">
							<h2>Калькулятор</h2>
							<script language=javascript>
zonecount = 5;
zone = new Array("-",
"Москва",
"Внутри ТТК",
"Внутри Сад. кольца",
"!добавлять выше! это не трогать!!!"
);
cost = new Array( 
	new Array(4,0),

	new Array( "Газель-тент 3м/9куб",
				     400,     450,     450,    0,0, 25,     3), //2
	new Array( "Газель-будка 3м/9куб",
				     400,     450,     450,   0,0,  25,     3), //3
	new Array( "Газель-тент 4м/17куб",
				     450,     470,     500,   0,0,  25,     3), //4
	new Array( "Газель-будка 4м/17куб",
				     450,     470,     500,   0,0,  25,     3), //5
	new Array("!добавлять выше! это не трогать!!!",0,0,0,0,0,0,0)
);
gcost = new Array( new Array(4,0),
 new Array("Не требуются",0," "),
 new Array("Помощь водителя", 1000, " "),
 new Array("С грузовым лифтом", 1000, "/4 часа"),
 new Array("без лифта", 1200, "/4 часа"),
 new Array("!добавлять выше! это не трогать!!!",0)
);
expeditor = 500;


function unCalculate(){
	document.getElementById("itog").innerHTML  = "";
}	


function Calculate(){
	var summa = 0;
	var caridx = document.f.s1.selectedIndex;
	if( caridx > 0){ 
		var zidx = document.f.Swhere.value;
		var time = document.f.Stime.value;
		var mkd = parseInt("0"+document.f.mkad.value,10);
		document.f.mkad.value = mkd;
		summa = time*cost[caridx][zidx] + cost[caridx][zidx] + mkd*cost[caridx][zonecount+1];
		
	}
	var gidx = document.f.Sgruz.selectedIndex + 1;
	if(gidx > 1){
		
		if( gidx==2 ){ summa = summa + gcost[gidx][1]; }
		else {	summa = summa + document.f.Sgcount.value*document.f.Sgtime.value*(gcost[gidx][1]/4)};
	}
	if( document.f.Exped.checked ) { summa = summa + expeditor; }
	
	document.getElementById("itog").innerHTML  = summa + " руб.";
}


function Start1(){
	document.f.Swhere.disabled = true;
	document.f.Stime.disabled = true;
	document.f.Exped.disabled = true;
	document.f.Swhere.selectedIndex = 0;
	document.f.Stime.selectedIndex = 0;
}
function Start2(){
	document.f.Sgruz.selectedIndex = 0;
	document.f.Sgcount.selectedIndex = 0;
	document.f.Sgcount.disabled = true;
		
	document.f.Sgtime.selectedIndex = 0;
	document.f.Sgtime.disabled = true;	
}
function Start0(){

	for(i=document.f.s1.length-1;i>=1;i=i-1){ document.f.s1.options[i]=null; }
	for(i=1;i<=(cost[0][0]);i=i+1){ document.f.s1.options[i] = new Option(cost[i][0],i)};

	for(i=document.f.Sgruz.length-1;i>=0;i=i-1){ document.f.Sgruz.options[i]=null; }
	for(i=1;i<=(gcost[0][0]);i=i+1){ document.f.Sgruz.options[i-1] = new Option(gcost[i][0]+"   ("+gcost[i][1]+" руб."+gcost[i][2]+")",i)};

	document.getElementById ("exptext").innerHTML = "Услуги Экспедитора (" + expeditor + " руб.)";
	Start1(); Start2();

}

function ShowC1(){
	var caridx = document.f.s1.selectedIndex;
	var zidx = document.f.Swhere.value;
	var c1 = 0;
	var cm = 0;
	if( caridx > 0){ 
		c1 = cost[caridx][zidx];
		cm = cost[caridx][zonecount+1];
	}
	//document.getElementById("C1").innerHTML  = c1;
	document.getElementById("costmkad").innerHTML  = cm;
	
	unCalculate();

}
function ShowC2(){
	return;
	var gidx = document.f.Sgruz.selectedIndex;
	var c2 = 0;
	var c3 = "";
	if( gidx > 0){ 
		c2 = gcost[gidx];
	}
	if( gidx > 1){ 
		c3 = "/4 часа";
	}
	document.getElementById("C2").innerHTML  = c2;
	document.getElementById("C3").innerHTML  = c3;

	unCalculate();
}



function SelectCar(){
	var caridx = document.f.s1.selectedIndex;
	if( caridx == 0) { Start1(); Calculate(); return; }


	//Zone
	document.f.Swhere.disabled = false;
	document.f.Swhere.selectedIndex = 0;
	document.f.Exped.disabled = false;
	
	for(i=document.f.Swhere.length-1;i>=0;i=i-1){ document.f.Swhere.options[i]=null; }
	for(i=1;i<=(zone.length-2);i=i+1){ document.f.Swhere.options[i-1] = new Option(zone[i]+"   ("+cost[caridx][i]+" руб./ч)",i)};
	
	//Time
	for(i=document.f.Stime.length-1;i>=0;i=i-1){ document.f.Stime.options[i]=null; }
	ftime = cost[caridx][7];
	document.f.Stime.options[0] = new Option(ftime,ftime,true,true);
	j=1;
	for(i=ftime+1;i<=12;i=i+1){
		document.f.Stime.options[j]= new Option(i,i);
		j=j+1;
	}
	document.f.Stime.disabled = false;	
	ShowC1();
}
function SelectGruz(){

	var gidx = document.f.Sgruz.selectedIndex;
	unCalculate(); 
	if( gidx < 1) { Start2(); return; }
	if( gidx == 1) { Start2(); document.f.Sgruz.selectedIndex=1; return; }
	
	document.f.Sgcount.selectedIndex = 0;
	document.f.Sgcount.disabled = false;
		
	document.f.Sgtime.selectedIndex = 0;
	document.f.Sgtime.disabled = false;	

}
							</script>
							<form name="f" action="--WEBBOT-SELF--" method="post">
								Транспорт:
								<select name="s1" class="select" onchange="SelectCar();" size="1">
									<option selected="selected" value="0">Выберите тип транспорта:</option>
								</select>
								<select name="Swhere" class="select" onchange="ShowC1();unCalculate();" size="1">
									<option selected="selected" value="1">Москва</option>
									<option value="2">АМОЖД</option>
									<option value="3">ТТК</option>
									<option value="4">Садовое кольцо</option>
									<option value="5">Китай-город</option>
								</select>
								<p class="pcal">Время:</p> 
								<select name="Stime" class="select" size="1">
									<option selected="selected" value="3">3</option>
								</select>
								<div class="pcalspan">+ 1 час подачи</div>
								<p class="pcal" style="padding-top:3px">От МКАД (км): </p>
								<input type="text" class="select2" name="mkad" onclick="unCalculate();" size="8" />
								<div class="pcalspan2"> х <span id="costmkad">0</span> руб./км</div>
								<p class="pcal" style="padding-top:3px"><input type="checkbox" value="ON" name="Exped" onchange="unCalculate();" /><span id="exptext"> Услуги экспедитора</span></p>
								<p class="pcal">Грузчики:</p>
								<select class="select3" name="Sgruz" onchange="ShowC2();SelectGruz();" size="1">
									<option selected="selected" value="0">Не требуются</option>
									<option value="1">Помощь водителя</option>
									<option value="2">С грузовым лифтом)</option>
									<option value="3">Грузчики (без лифта)</option>
								</select>
								<p class="pcal">Количество:</p> 
								<select class="select" name="Sgcount" size="1">
									<option selected="selected" value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select> 
								<p class="pcal">Время:</p> 
								<select class="select" name="Sgtime" size="1">
									<option selected="selected" value="4">4 часа</option>
									<option value="5">5 часов</option>
									<option value="6">6 часов</option>
									<option value="7">7 часов</option>
									<option value="8">8 часов</option>
									<option value="9">9 часов</option>
									<option value="10">10 часов</option>
									<option value="11">11 часов</option>
									<option value="12">12 часов</option>
								</select>
								<p><input type="button" class="buttoncal" value="Рассчитать" name="B3" onclick="Calculate();" /></p>
								<p class="pcal"><b>ИТОГО: </b></p>
								<span id="itog">0</span>
								<span lang="ru">
									<script language=javascript>
									document.f.s1.selectedIndex = 0;
									Start0();
									document.f.Exped.checked = false;
									unCalculate();
									</script>
								</span>
							</form>
						</div>
						</noindex>
					
