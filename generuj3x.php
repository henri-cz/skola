<?php
//30.11.2010 uprava pro tri pokusy za den
//PROJEKT gnerovani  testu
//18.1.07  sifrovani textu
//rustina zmenou 1250 ya 1251 pokud prvni znak je zavinac  
//test heslo pri vstupu


$ts=$_GET['ts'];
$student=$_GET['student'];
$trida=$_GET['trida'];
$id=$_GET['id'];

require "session.php"; 

include('../cls/security.class.php');

$security = new clsSecurity;

if ($security -> verifySecValues2($ts))
{
 include ("db.php");  
 mysql_connect($host,$user,$passwd) or die("nepovedlo se spojit!");
 mysql_select_db($dbname) or die("nepovedlo se vybrat databázi"); 
 mysql_query('SET NAMES UTF8');
  
 $jmeno=$student;  
 $tabulka="testy9";  
//dotaz na 3 pokusy
 $datum=date("Y-m-d");
 $dotaz = "SELECT * from $tabulka where  prijmeni=\"$student\" AND trida=\"$trida\" AND datum=\"$datum\" ";
  $vysled=mysql_query($dotaz);
  $pocet_radku = mysql_num_rows($vysled);
  if  ($pocet_radku >=3 )
  {
   echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
   echo "<h1>Počet pokusů pro dnešní den je vyčerpán</h1>";
  }
else
{
 $dotaz = "SELECT otazky, doba, poc_otazek, odpovedi FROM banka WHERE id_testu=$id";
  $vysl = mysql_query($dotaz);
  $pole = mysql_fetch_array($vysl);   
  $pocet=strlen($pole[0]); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php
//rustina
if ( $pole[0][0]=='@')echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1251\">";
  else echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
?>
<title>
EPI
</title>
<meta name="description" content="testy">
<meta name="keywords" content="testy">
<meta name="author" content="Studio JiP e-mail: ">
<style type="text/css" media="screen">@import "default.css";</style>
<script language="JavaScript" type="text/javascript"><!----------------------
var q = [
<?php
//generovani WWW stranky testu
  $dotaz = "SELECT otazky, doba, poc_otazek, odpovedi FROM banka WHERE id_testu=$id";
  $vysl = mysql_query($dotaz);
  $pole = mysql_fetch_array($vysl);   
  $pocet=strlen($pole[0]);
  $vys="";$pol[0]="";$pol[1]="";$pol[2]="";$pol[3]="";$pol[4]="";
  $zac=1;
  $cislo=1;
  for($i=0; $i<$pocet; $i++)
  {
    if (ord($pole[0][$i])==10)
    {//rozbor
       //echo ("$pom");
       if ($pom[0]!='.') $pol[$odp]=$pol[$odp].$pom;
       if (($pom[0]=='.')&&($pom[1]!='.'))
       {    
        if ($zac==0)
        {
          //echo("[ \"$pol[0]\", \"$pol[1] \",\"$pol[2]\",\"$pol[3]\",\"$pol[4]\"],\n");
           $kod="";
          for($ii=0; $ii<strlen($pol[0]); $ii++)
          {
            if (((ord($pol[0][$ii])>=65 ) && (ord($pol[0][$ii])<=90 )) ||
                ((ord($pol[0][$ii])>=97 ) && (ord($pol[0][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[0][$ii])-1);
            else $kod.=chr(ord($pol[0][$ii]));
           } 
          $otazka[$cislo][0]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[1]); $ii++)
          {
            if (((ord($pol[1][$ii])>=65 ) && (ord($pol[1][$ii])<=90 )) ||
                ((ord($pol[1][$ii])>=97 ) && (ord($pol[1][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[1][$ii])-1);
            else $kod.=$pol[1][$ii];  
           }   
          $otazka[$cislo][1]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[2]); $ii++)
          {
            if (((ord($pol[2][$ii])>=65 ) && (ord($pol[2][$ii])<=90 )) ||
                ((ord($pol[2][$ii])>=97 ) && (ord($pol[2][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[2][$ii])-1);
            else $kod.=$pol[2][$ii];  
           }   
          $otazka[$cislo][2]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[3]); $ii++)
          {
            if (((ord($pol[3][$ii])>=65 ) && (ord($pol[3][$ii])<=90 )) ||
                ((ord($pol[3][$ii])>=97 ) && (ord($pol[3][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[3][$ii])-1);
            else $kod.=$pol[3][$ii];  
           }   
          $otazka[$cislo][3]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[4]); $ii++)
          {
            if (((ord($pol[4][$ii])>=65 ) && (ord($pol[4][$ii])<=90 )) ||
                ((ord($pol[4][$ii])>=97 ) && (ord($pol[4][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[4][$ii])-1);
            else $kod.=$pol[4][$ii];  
           }   
          $otazka[$cislo][4]=$kod;
          /*
          $otazka[$cislo][1]=$pol[1];
          $otazka[$cislo][2]=$pol[2];
          $otazka[$cislo][3]=$pol[3];
          $otazka[$cislo][4]=$pol[4];
*/
          $cislo++;
        } 
        if ($zac==1) $zac=0;
        $pol[0]="";$pol[1]="";$pol[2]="";$pol[3]="";$pol[4]="";
       //echo ("otazka *** <br>");
       $pom[0]=" ";
       $odp=0; $pol[$odp]=$pol[$odp].$pom;
       }
       if (($pom[0]=='.')&&($pom[1]=='.')&&($pom[2]!='.'))
       {
        $pom1="";
        for($j=2; $j<strlen($pom); $j++)$pom1=$pom1.$pom[$j];
        //echo ("odpoved spatna *** <br>");
        $odp++;
        $pol[$odp]=$pol[$odp].$pom1;
       }
       if (($pom[0]=='.')&&($pom[1]=='.')&&($pom[2]=='.')&&($pom[3]!='.'))
       {
        //echo ("odpoved spravna *** $odp  = ");
        $odp++;
        $pom1="";
        for($j=3; $j<strlen($pom); $j++)$pom1=$pom1.$pom[$j];
        $pol[$odp]=$pol[$odp].$pom1;
        //echo (chr(ord('A')+$odp));echo (" <br>");
        $vys=$vys.chr(ord('A')+$odp);
       }
       $pom=""; 
    }
    else
    {
     if (($pole[0][$i]=='"')||($pole[0][$i]=='\\')) $pom=$pom."\\";
     if (ord($pole[0][$i])==13)$pom=$pom.'\n';
     else $pom=$pom.$pole[0][$i];
    } 
    //echo ($pole[0][$i]);echo (ord($pole[0][$i]));echo ("<br>");
  }
   //echo("[ \"$pol[0]\", \"$pol[1] \",\"$pol[2]\",\"$pol[3]\",\"$pol[4]\"]\n");
      //zasifrovani textu posunem znaku v ASCII tabulce
          $kod="";
          for($ii=0; $ii<strlen($pol[0]); $ii++)
          {
            if (((ord($pol[0][$ii])>=65 ) && (ord($pol[0][$ii])<=90 )) ||
                ((ord($pol[0][$ii])>=97 ) && (ord($pol[0][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[0][$ii])-1);
            else $kod.=$pol[0][$ii];  
           }   
          $otazka[$cislo][0]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[0]); $ii++)
          {
            if (((ord($pol[0][$ii])>=65 ) && (ord($pol[0][$ii])<=90 )) ||
                ((ord($pol[0][$ii])>=97 ) && (ord($pol[0][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[0][$ii])-1);
            else $kod.=$pol[0][$ii];  
           }   
          $otazka[$cislo][0]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[1]); $ii++)
          {
            if (((ord($pol[1][$ii])>=65 ) && (ord($pol[1][$ii])<=90 )) ||
                ((ord($pol[1][$ii])>=97 ) && (ord($pol[1][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[1][$ii])-1);
            else $kod.=$pol[1][$ii];  
           }   
          $otazka[$cislo][1]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[2]); $ii++)
          {
            if (((ord($pol[2][$ii])>=65 ) && (ord($pol[2][$ii])<=90 )) ||
                ((ord($pol[2][$ii])>=97 ) && (ord($pol[2][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[2][$ii])-1);
            else $kod.=$pol[2][$ii];  
           }   
          $otazka[$cislo][2]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[3]); $ii++)
          {
            if (((ord($pol[3][$ii])>=65 ) && (ord($pol[3][$ii])<=90 )) ||
                ((ord($pol[3][$ii])>=97 ) && (ord($pol[3][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[3][$ii])-1);
            else $kod.=$pol[3][$ii];  
           }   
          $otazka[$cislo][3]=$kod;
          $kod="";
          for($ii=0; $ii<strlen($pol[4]); $ii++)
          {
            if (((ord($pol[4][$ii])>=65 ) && (ord($pol[4][$ii])<=90 )) ||
                ((ord($pol[4][$ii])>=97 ) && (ord($pol[4][$ii])<=109 ))) 
                    $kod.=chr(ord($pol[4][$ii])-1);
            else $kod.=$pol[4][$ii];  
           }   
          $otazka[$cislo][4]=$kod;
        // $otazka[$cislo][0]=$pol[0];
        //$otazka[$cislo][1]=$pol[1];
        //$otazka[$cislo][2]=$pol[2];
        //$otazka[$cislo][3]=$pol[3];
        //$otazka[$cislo][4]=$pol[4];
          $cislo++;
//  echo ("];\n");
//  echo ("var tt=$id\n");
//  echo ("var min=$pole[1]\n");
  //generovani nahodne dle poctu otazek
  $cislo--;
  srand();
  $delka=$pole[2];
  if (($delka>$cislo)||($delka==0)) $delka=$cislo;
  $r1=$cislo;
  $ot[0]= rand(1,$cislo);
  $ok=0;
  for($j=1;$j<$delka;$j++)
  {
  while($ok==0)
  {
    $r = rand(1,$cislo); 
    $ok=1;   
    for($u=0;$u<$j;$u++) {if ($ot[$u]==$r) $ok=0;}
  }//while
   $ot[$j]=$r;
   $ok=0;
  }//for
//  printf("<html><body><table>\n");
//vytvoreni pole otazek pro javascript format
  $aaa="";
  for($i=0; $i<$delka; $i++)
  {
    //printf("<tr><td>%d<td>%d<td>%s\n",$i,$ot[$i],$otazka[$ot[$i]][0]);
       if ($i==$delka-1) //posledni otazka bez cerka za hran.zav
       printf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"]\n",
       $otazka[$ot[$i]][0],
       $otazka[$ot[$i]][1],
       $otazka[$ot[$i]][2],
       $otazka[$ot[$i]][3],
       $otazka[$ot[$i]][4]
       );
       else 
       printf("[\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"],\n",
       $otazka[$ot[$i]][0],
       $otazka[$ot[$i]][1],
       $otazka[$ot[$i]][2],
       $otazka[$ot[$i]][3],
       $otazka[$ot[$i]][4]
       );
       $aaa=$aaa.$ot[$i];$aaa=$aaa."a";           
  } 
//  printf("</table></body></html>");
  echo ("];\n");
  echo ("var tt=$id;\n");
  echo ("var min=$pole[1];\n");
//vlozeni odpovedi  
  $p_odpovedi=$pole[3];
  $odpoved_p="";
/*
  for($i=0; $i<$delka; $i++)
  {
      //$odpoved_p.='"'.$p_odpovedi[$ot[$i]].'",';
      $odpoved_p.='"'.$p_odpovedi[$ot[$i]-1].'",';
  } 
*/
//generovani odpovedi pozpatku s posumen o 1 v ASCII tabulce
  for($i=$delka-1; $i>0; $i--) 
      $odpoved_p.='"'.chr(ord($p_odpovedi[$ot[$i]-1])+1).'",';
      $odpoved_p.='"'.chr(ord($p_odpovedi[$ot[$i]-1])+1).'"';//posledni bez carky
  //echo ("var aox=[ $odpoved_p ];\n");
?>
var spravne=0;
var spatne=0;
var odpoved;
var i,c1;
var c2 = "a";
var otx="";
var qp = new Array(q.length);
var odpovedi = new Array(q.length);
var itmp = new Image();
var itmpok = new Image();
var itmpfail = new Image();
itmp.src = "otaz.jpg";
itmpok.src = "ok.jpg";
itmpfail.src = "kriz.jpg";
var lastIndex=-1;
var zac=0;
var sec=0;
function zvetsi1(){ document.answer.q.rows =document.answer.q.rows+1;}
function zmensi1(){ document.answer.q.rows =document.answer.q.rows-1;}
function zvetsi2(){ document.answer.q1.rows =document.answer.q1.rows+1;}
function zmensi2(){ document.answer.q1.rows =document.answer.q1.rows-1;}
function hodiny()
{
  if (zac==1)
  {
  if (sec==0) {min--;sec=60;}
    cas=1;
    document.answer.hod.value = "Zbývá   min: "+min+"  sec: "+sec;
    window.status=" test  min: "+min+"  sec: "+sec;
    sec--;
    window.setTimeout("hodiny()", 1000);
    if (min<0){ cas=0; kon(); }
  }  
}
function ShowQuestion(theIndex) {
        if (zac==0) 
        { 
            zac=1;hodiny();
            //test vyplneni hlavicky
            prijmeni = document.answer.jmeno.value;
            trida = document.answer.trida.value;
            if (prijmeni=="" || trida=="")
            {
              zac=0;alert("Vyplňte jméno a třídu DĚKUJEME");
            }  
        } 
  if (zac==1)
  {
	document.answer.q.value = "";
	document.answer.r.value = "";
	document.answer.odpoved[0].checked=false;
	document.answer.odpoved[1].checked=false;
	document.answer.odpoved[2].checked=false;
	document.answer.odpoved[3].checked=false;
	if(!qp[ot[theIndex]]) {
    otx="";
    for (i=0;i<q[ot[theIndex]][0].length;i++)
    {
     c1=q[ot[theIndex]][0].charCodeAt(i);
     if ((c1>=64)&&(c1<=89) || (c1>=96)&&(c1<=108)) c1=c1+1;
      c2=String.fromCharCode(c1);
     otx=otx+c2; 
    }
    document.answer.q.value=otx;
	  //q[ot[theIndex]][0];
    otx1="";
    for (i=0;i<q[ot[theIndex]][1].length;i++)
    {
     c1=q[ot[theIndex]][1].charCodeAt(i);
     if ((c1>=64)&&(c1<=89) || (c1>=96)&&(c1<=108)) c1=c1+1;
      c2=String.fromCharCode(c1);
     otx1=otx1+c2; 
    }
    otx2="";
    for (i=0;i<q[ot[theIndex]][2].length;i++)
    {
     c1=q[ot[theIndex]][2].charCodeAt(i);
     if ((c1>=64)&&(c1<=89) || (c1>=96)&&(c1<=108)) c1=c1+1;
      c2=String.fromCharCode(c1);
     otx2=otx2+c2; 
    }
    otx3="";
    for (i=0;i<q[ot[theIndex]][3].length;i++)
    {
     c1=q[ot[theIndex]][3].charCodeAt(i);
     if ((c1>=64)&&(c1<=89) || (c1>=96)&&(c1<=108)) c1=c1+1;
      c2=String.fromCharCode(c1);
     otx3=otx3+c2; 
    }
    otx4="";
    for (i=0;i<q[ot[theIndex]][4].length;i++)
    {
     c1=q[ot[theIndex]][4].charCodeAt(i);
     if ((c1>=64)&&(c1<=89) || (c1>=96)&&(c1<=108)) c1=c1+1;
      c2=String.fromCharCode(c1);
     otx4=otx4+c2; 
    }
/*
	  document.answer.q1.value=
	  "Varianty odpovědi\n\n A)  "
	  +q[ot[theIndex]][1]+" B)  "
	  +q[ot[theIndex]][2]+" C)  "
	  +q[ot[theIndex]][3]+" D)  "
	  +q[ot[theIndex]][4];
*/
	  document.answer.q1.value=
	  "\n A)  "
	  +otx1+" B)  "
	  +otx2+" C)  "
	  +otx3+" D)  "
	  +otx4;
	  document.images["que"+theIndex].src=itmp.src;
	  lastIndex = theIndex;
	} else {
	  lastIndex = -1;
	}
  }
}
function akcex()
 {
   if(lastIndex==-1)
   {
	document.answer.odpoved[3].checked = false;
	alert("Nejprve vyberte otázku!");
   }
   else
  {
   if(qp[ot[lastIndex]]==true) alert ("Nepodváděj, už jsi odpověděl!");
   else {
	   od=false;
     //i=aox.length;
	  if ( document.answer.odpoved[0].checked == true)odpovedi[ot[lastIndex]]='A';
	  if ( document.answer.odpoved[1].checked == true)odpovedi[ot[lastIndex]]='B';
	  if ( document.answer.odpoved[2].checked == true)odpovedi[ot[lastIndex]]='C';
	  if ( document.answer.odpoved[3].checked == true)odpovedi[ot[lastIndex]]='D';
	  if ( document.answer.odpoved[4].checked == true)odpovedi[ot[lastIndex]]='N';
			document.answer.odpovedi.value = "*** Odpověď! ***";
			document.images["que"+lastIndex].src=itmpok.src;
     kon();
   }
 }
}
function kon1()
{
   if  (lastIndex != -1) qp[ot[lastIndex]]=true;
   odpoved=1;
   for (i=0;i<q.length;i++) if(qp[i]!=true) odpoved=0;
   if ((odpoved == 1)|| (cas==0))
   {
  text="http://iss.vos.cz/testy/beta/main/epi/vysl.php?prijmeni="+prijmeni+"&trida="+trida+"&typ="+tt+"&vysl="+text+"&z="+z+"&cas1="+cas1+"&ts="+ts
,"okno", "width=550,height=400,menubar=yes,resizable=yes,left=0,top=0"; 
     alert("Do okna otázek je zkopirován text, který pošlete emailem na adresu školy.")
     document.answer.q.value=text;
   }
   else 
   {
    alert ("Ještě není dokončen test!");
   } 
}
function kon()
{
var proc;
   if  (lastIndex != -1) qp[ot[lastIndex]]=true;
   odpoved=1;
   for (i=0;i<q.length;i++) if(qp[i]!=true) odpoved=0;
   if ((odpoved == 1)|| (cas==0))
   {
     alert("KONEC TESTU \n v případě, že nedojde k zobrazení výsledku\n pokračujte kliknutím na tlačítko\n zaslání odpovědí po chybě serveru. ");
     text=""
     for (i=0;i<q.length;i++)
     { 
       text=text+odpovedi[i];
     }
      prijmeni = document.answer.jmeno.value;
      trida = document.answer.trida.value;
      z = document.answer.z.value;
      cas1=document.answer.cas1.value;
      ts=document.answer.ts.value;
  window.location.href="http://iss.vos.cz/testy/beta/main/epi/vysl.php?prijmeni="+prijmeni+"&trida="+trida+"&typ="+tt+"&vysl="+text+"&z="+z+"&cas1="+cas1+"&ts="+ts
,"okno", "width=550,height=400,menubar=yes,resizable=yes,left=0,top=0"; 
    zac=0;
   }
}
//------------------></script></head>
<div id="page">
<div id="header">
<div id="logo">
TESTY EPI Kunovice
</div>
</div>
<form name="answer" action="xx.php" method="post">
<?  
$cas=date("G:i:s");
printf("<h1> Příjmení: <input type=\"text\" name=\"jmeno1\" value=\"%s\">",$jmeno);
printf(" Třída: <input type=\"text\" name=\"trida1\" value=\"%s\"> ",$trida);
printf(" <input type=\"hidden\" name=\"jmeno\" value=\"%s\">",$jmeno);
printf(" <input type=\"hidden\" name=\"trida\" value=\"%s\">",$trida);
printf(" <input type=\"hidden\" name=\"z\" value=\"%s\">",$aaa);
printf(" <input type=\"hidden\" name=\"cas1\" value=\"%s\">",$cas);
printf(" <input type=\"hidden\" name=\"ts\" value=\"%s\">",$ts);
 ?>
 <input type="hidden" name="r" style="border:none;color:red" size="1">
  Čas: <input name="hod" style="border:none;color:blue" size="30">
</h1>
<table border="0" cellspacing="0" cellpadding="0" width="100%" background="carka2.jpg">
  <tr>
    <td align="center" valign="middle">
<table width="5" height="50" border="0" background="carka2.jpg" title="carka2" cellspacing="0" cellpadding="3">
    <tr>
      <td> <h1>Výběr <br> otázky:&nbsp; </h1></td>
      <td>
      <script language="JavaScript" type="text/javascript"><!----------------------
var ot = new Array(q.length);
var i,j,x,r,u,ok,delka;
  delka=q.length;
  r1=q.length-1;
  ot[0]= Math.random();
  ok=0;
  for(j=0;j<delka;j++)
  {
  while(ok==0)
  {
    r = Math.round(Math.random()*r1); 
    ok=1;   
    for(u=0;u<j;u++) {if (ot[u]==r) ok=0;}
  }//while
   ot[j]=r;
   ok=0;
   //alert(j+"  "+r);
  }//for
for( i=0; i<q.length; i++ ) {
 x=i+1;
  document.write(x+"<a href='javascript:void(0)' onClick='ShowQuestion("+i+")'><img name='que"+i+"' src='otaz1.jpg' border='0' width='30' height='20'></a>&nbsp;");
  if((i%14)==13)	 document.write("<br>");
  odpovedi[i]='X'; 
}
ostry=true;
//------------------></script></td>
    </tr>
    <tr>
      <td ><h1>Otázka:</h1>
      <br>
      <INPUT TYPE="button" VALUE="+ okno" onClick="zvetsi1()"><br>
      <INPUT TYPE="button" VALUE="-  okno" onClick="zmensi1()">
      </td>
      <td><textarea rows="10" name="q" cols="93"
       style="border: 1px solid #990000;background: #e6e6e6;margin: 2px 2px 2px 2px;font-family: arial, sans serif;font-size: 100%"
       ></textarea ></td>
    </tr>
   <tr><td></td><td><INPUT TYPE="button" name="zaloha" value="Zaslání odpovědí po chybě serveru"	onClick="kon1()" ></td></tr>
   <tr><td></td><td><br>Varianty odpovědí</td></tr>
    <tr>
      <td ><h1>Odpověď:</h1>
      <br>
      <INPUT TYPE="button" VALUE="+ okno" onClick="zvetsi2()"><br>
      <INPUT TYPE="button" VALUE="-  okno" onClick="zmensi2()">
      </td>
      <td >
  <BR>
  <textarea rows="10" name="q1" cols="93"
        style="border: 1px solid #006600;background: #ccffff;margin: 2px 2px 2px 2px;color:blue;font-family: arial, sans serif;font-size: 100%">
</textarea >
  <BR>
  <INPUT TYPE="radio" name="odpoved" value="A"	onClick="akcex()" > A
  <INPUT TYPE="radio" name="odpoved" value="B"	onClick="akcex()" > B
  <INPUT TYPE="radio" name="odpoved" value="C"	onClick="akcex()" > C
  <INPUT TYPE="radio" name="odpoved" value="D"	onClick="akcex()" > D
  <input type="radio" name="odpoved" value="N"  onclick="akcex()" > Nevim
  <input name="odpovedi" style="border:none;color:blue" size="50">
  </td></tr>
</td>
</tr>
</table>
</td>
</tr>
</table>
</font>
</form>
<div id="footer">
Copyright &copy; 2005, Studio JiP.
</div>
</div>
</body>
</html>
<?
}//test spravnosti hash
}
else
{
  echo 'Ale, ale, ale';
}
?>