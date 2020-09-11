$(document).ready(function(){
  
    function proizvodUKorpi() {
        return JSON.parse(localStorage.getItem("products"));
    }
    $("#sredina2").on("click",".kupi",function(){
       
        var id= $(this).data("id")
      console.log(id)
      
        var products = proizvodUKorpi();
    
        if(products) {
            if(productIsAlreadyInCart()) {
                updateQuantity();
            } else {
                addToLocalStorage()
            }
        } else {
            addFirstItemToLocalStorage();
        }
    
        alert("Proizvod ste dodali u korpu! Potvrdite kupovinu klikom na korpu!");
    
        
        function productIsAlreadyInCart() {
            return products.filter(p => p.id == id).length;
        }
    
        function addToLocalStorage() {
            let products = proizvodUKorpi();
            products.push({
                id : id,
                quantity : 1
            });
            localStorage.setItem("products", JSON.stringify(products));
        }
    
        function updateQuantity() {
            let products = proizvodUKorpi();
            for(let i in products)
            {
                if(products[i].id == id) {
                    products[i].quantity++;
                    break;
                }      
            }
    
            localStorage.setItem("products", JSON.stringify(products));
        }
    
        
    
        function addFirstItemToLocalStorage() {
            let products = [];
            products[0] = {
                id : id,
                quantity : 1
           }
            localStorage.setItem("products", JSON.stringify(products));
        }
    })
   

$.ajax({
    url:"models/proizvodi/proizvodi.php",
    dataType:"json",
    type:"post",
    success:function(sve){
       ispis(sve)
    }
    })
    function ispis(proiz){
        let ispis="";
        for(let i of proiz){
            ispis+=`<div class='limprvi'>
           
            <img src='${i.mala_slika}' class='mslikaa'/>
            <div id='opis'>
            <span class='mar'>Marka:</span><span class='marka'>${i.Naziv}</span><br/>
            <span class='mod'>Model:</span><span class='model'>${i.Model}</span><br/>
            <span class='spec'>Specifikacije:</span> <span class='specifikacije'>${i.Opis}
            </span><br/>
            <span class='cen'>Cena:</span><span class='cena' id='cenaa'>${i.cena} RSD</span>
            </div>
            <a href='#' id='opsirnije' class="opsirno" value='Opsirnije'  data-id='${i.idProizvod}'>Opširnije</a>
            
            <a href='#' class='kupi' name='kupi' data-id='${i.idProizvod}'>Kupi<i class='fas fa-shopping-cart'
            id='korpa'></i></a>
          
            
            
            </div>`
        }
        $("#sredina2").html(ispis);
        $(".opsirno").click(function(){
           prikazi($(this).data("id"))
        })
    }
   
    // detaljni pikaz proizvoda
    function prikazi(pr){
       var id=pr
       $.ajax({
        url:"models/proizvodi/detljproizvod.php",
        dataType:"json",
        type:"post",
        data:{id,id},
        success:function(sve){
            var ispis="";
           var pr=sve.Opis.split(",");
          ispis+=`"
          <i class='fas fa-times' id='iks'></i>	
          <div id='slikaproiz'>
      <img src='${sve.velika_slika}' class='slikapr'/>
      </div>
      <div id='proizopis'>
      <table id='proiztabla'>
      <tr><td>Marka poizvoda:</td><th>${sve.Naziv}</th></tr>
      <tr><td>Model:</td><th>${sve.Model}</th></tr>
      <tr><td>Boja:</td><th>${pr[0]}</th></tr>
      <tr><td>Dijagonala ekrana:</td><th>${pr[1]}</th></tr>
       <tr><td>Procesor:</td><th>${pr[2]}</td></tr>
          <tr><td>Kamera</td><th>${pr[4]}</th></tr>
          <tr><td>Ram</td><th>${pr[3]}</th></tr>
      <tr><td>Cena</td><th>${sve.cena} RSD</th></tr>
      
      </table>
   
      </div>`
      document.getElementById("proizvod").innerHTML=ispis
      
      
      $(".opsirno").click(function(){
        $("#proizvod").css("display","flex")
        })
        $("#iks").click(function(){
            $("#proizvod").css("display","none")
            })
 }})}


    //dinamicki filter lista
$.ajax({
    url:"models/dinamickifilterlista.php",
    dataType:"json",
    type:"post",
    success:function(sve){
        let ispis="Izaberi marku:<select id='filterlista'><option value='0'>Izaberite</option>"
        for(let i of sve){
        ispis+=`<option value='${i.idMarka}' data-id='${i.idMarka}'>${i.Naziv}`
        
        }
    ispis+=`</select>`
    var is=`<input type="text"/>`
    $("#sortiranje").html(ispis)
   
    $("#filterlista").change(function(){
        filtriraj()})    
    }})

  
// filtriranje proizvoda po marki!
    function filtriraj(){
        var id=$("#filterlista").val();
        var  vrednost=$("#sortcena").val();
    var idpag=$("#pag").data("id");
       
$.ajax({
url:"models/proizvodi/paginacija.php",
dataType:"json",
type:"post",
data:{id:id,send:true,vrednost:vrednost,idpag:idpag},
success:function(x){
    console.log(x)
   ispis(x)
  
   opsirnoizlaz()
    },error:function(xhr,status,error){
        console.log(xhr,error,status)
    }
})
$.ajax({
    url:"models/proizvodi/filterpag.php",
    dataType:"json",
    type:"post",
    data:{id:id},
    success:function(c){
        pisipaginaciju(c);
       
    },error:function(xhr,status,error){
            console.log(xhr,status,error)
        }})}
  

function pisipaginaciju(c){
 

    var limit=6;
    var total=Math.ceil(c.brojproizvoda/limit);
    var iss="<div class='pagination'>";
    for(var i=1;i<=total;i++){
        iss+=`<a href='javascript:void(0)' value=${i} data-id=${i}  id='pag'>${i}</a>`;  
    }
$("#paginacija").html(iss);


}

sve()
function sve(){

var id=0;
$.ajax({
    url:"models/proizvodi/filterpag.php",
    dataType:"json",
    type:"post",
    data:{id:id},
    success:function(c){
pisipaginaciju(c)
    }})}
//trazi

$("#trazii").keyup(function(){
    trazi(this.value)
})
function trazi(rez){

    console.log("a")
   var naziv= rez
   $.ajax({
   url:"models/proizvodi/trazi.php",
   dataType:"json",
   type:"post",
   data:{naziv:naziv},
   success:function(c){
   
        if(naziv!="" && c==""){
        document.getElementById("sredina2").innerHTML="<h2>Nema proizvoda po zadatom kriterijumu!<i class='far fa-frown'></i></h2>";
       }
       else{
       ispis(c)


       opsirnoizlaz()}}

})
$.ajax({
    url:"models/proizvodi/trazipag.php",
    dataType:"json",
    type:"post",
    data:{naziv:naziv},
    success:function(c){

        pisipaginaciju(c)
    }})}
//sortiranje proizvoda
$("#sortcena").change(function(){
    sortiraj()
})
function sortiraj(){
   var  vrednost=$("#sortcena").val();

   var idpag=$("#pag").data("id");
   console.log(idpag)
    var id=$("#filterlista").val();
 
   $.ajax({ url:"models/proizvodi/paginacija.php",
   dataType:"json",
   type:"post",
  
  
   data:{
       vrednost:vrednost,send:true,idpag:idpag,id:id},
   
       success:function(x){
   
        ispis(x);
       opsirnoizlaz()
       },error:function(xhr,status,error){
        console.log(xhr,error,status)
    }})}
function opsirnoizlaz(){
    return  $(".opsirno").click(function(){
        $("#proizvod").css("display","flex")
        })
        $("#iks").click(function(){
            $("#proizvod").css("display","none")
            })
}
//paginacija 
$("#paginacija").on("mouseover","#pag",function(){
$(this).css("background-color","#424040");

})
$("#paginacija").on("mouseout","#pag",function(){
    $(this).css("background-color","#15141457");
    
    })
$("#paginacija").on("click","#pag",function(){

    var idpag=$(this).data("id")
    console.log(idpag)
    var  vrednost=$("#sortcena").val();
    var id=$("#filterlista").val();
    $.ajax({
        url:"models/proizvodi/paginacija.php",
        dataType:"json",
        type:"post",
        data:{
        idpag:idpag,send:true,vrednost:vrednost,id:id},
        success:function(sve){
            ispis(sve)
        
        },
        error:function(xhr,status,error){
            console.log(xhr,status,error)
        }
       

        })})
    
    //azuriranje korisnika!

    $("#kor").on("click",".azuriraj",function(){

        var id=$(this).data("id");
        $.ajax({
            url:"models/korisnici/azurirajkphp.php",
            dataType:"json",
            type:"post",
            data:{
            id:id},
            success:function(sve){
              var ispis=""
              for(var rez of sve){
                  ispis+=`   <form name="listaupdate" action="#" method="POST" id="updateli"> 
    
                  <input type="hidden"  name="sakriveno"id="skriveno" value="${rez.idkorisnik}"/><br/>
                  <input type="text" class=" finsert" name="imei" id="imee" value="${rez.ime_i_prezime}"/><br/>
                  <input type="text" class="finsert" name="postai" id="email" value="${rez.email}"/><br/>
                  <input type="text" class="finsert" name="lozinkai"  id="lozinka" value="${rez.lozinka}"/><br/>
                  <input type="text" class="finsert" name="lozinkapi"  id="ponovo" value="${rez.lozinkaponovo}"/><br/>
                  <select name='uloge' id='lista'>"`
                 
                 
                      if(rez.naziv=='korisnik'){
                        ispis+=`<option value='${rez.iduloga}'>${rez.naziv}</option>
                        <option value='2'>admin</option>`
                      }
                      else{
           ispis+=`<option value='${rez.iduloga}'>${rez.naziv}</option>
           <option value='1'>korisnik</option>
           `}
            ispis+=`</select>
                  
            <div id="radiobi">
            <p>Pol:</p>
    `
        if(rez.pol=="Muski"){
         ispis+=`Muski<input type="radio" name="radi"id="rad2"class="radioi" value="Muski" checked/>&nbsp;
         Zenski<input type="radio" name="radi"id="rad3"class="radioi" value="Zenski"/>
         <input type="button" id="izmeni" value="Promeni" name="izmena"/>
        ` }
         
        if(rez.pol=="Zenski"){
           
             ispis+=` Muski<input type="radio" name="radi"id="rad2"class="radioi" value="Muski"/>&nbsp;
              Zenski<input type="radio" name="radi"id="rad3"class="radioi" value="Zenski" checked/>
              <input type="button" id="izmeni" value="Promeni" name="izmena"/>
       
       
                  
                  `

              }}
              document.getElementById("zakorisnika").innerHTML=ispis
            },
            error:function(xhr,status,error){
                console.log(xhr,status,error)
            }

    })
    
})
$("#zakorisnika").on("click","#izmeni",function(){
   var skriveno=document.getElementById("skriveno").value;
   var ime=document.getElementById("imee").value;
   var email=document.getElementById("email").value;
   var lozinka=document.getElementById("lozinka").value;
   var ponovo=document.getElementById("ponovo").value;
   var x=document.getElementById("lista")
   var sve=x.options[x.selectedIndex].value;
 var rad= document.getElementsByClassName("radioi");
 for(var aa of rad){
     if(aa.checked){
         var cekirani=aa.value
      
     }
 }
 $.ajax({
    url:"models/korisnici/azuriranjekorisnika.php",
    dataType:"json",
    type:"post",
    data:{skriveno:skriveno,ime:ime,email:email,lozinka:lozinka,ponovo:ponovo,sve:sve,cekirani:cekirani},
    success:function(sve){
alert("Korisnik izmenjen!")
prikaziKorisnikeBezOsvezavanja();



    }
    ,error:function(xhr,status,error){
        console.log(xhr,error,status)
    }})})

//prikaz proizvoda u admin panelu
$("#proizv").css("display","none")
$("#prikazipr").click(function(){
    $("#proizv").toggle()})

$("#prikazipr").click(function(){

  
    $.ajax({
        url:"models/proizvodi/prikazSvihProizvoda.php",
        dataType:"json",
        type:"post",
        success:function(sve){
         
            var ispis=`<table border="1px"id="prikazproizvoda"><tr><th>Marka</th><th>Model</th><th>Opis</th><th>Slika</th><th>Cena</th><th><input type="button" class="izdugme" value="Izbrisi"/></th><th>Azuriraj proizvod</th></tr>`
            for(var rezul of sve){
ispis+=` <td>${rezul.Naziv}</td><td>${rezul.Model}</td><td>${rezul.Opis}</td><td><img class="pozslika" src="${rezul.mala_slika}"/></td><td>${rezul.cena}</td><td><input type="checkbox" value="${rezul.idProizvod}" name="cekovii" id="cekovii"/></td><td><a href="#"class="azurirajpr" data-idpro="${rezul.idProizvod}">Azuriraj proizvod</a></td><td>
</tr>
`


            }
            ispis+="</table>"
            $("#proizv").html(ispis);
           
        }
    })})

    function prikaziProizvodPromena(){
        $.ajax({
            url:"models/proizvodi/prikazSvihProizvoda.php",
            dataType:"json",
            type:"post",
            success:function(sve){
             
                var ispis=`<table border="1px"id="prikazproizvoda"><tr><th>Marka</th><th>Model</th><th>Opis</th><th>Slika</th><th>Cena</th><th><input type="button" class="izdugme" value="Izbrisi"/></th><th>Azuriraj proizvod</th></tr>`
                for(var rezul of sve){
    ispis+=` <td>${rezul.Naziv}</td><td>${rezul.Model}</td><td>${rezul.Opis}</td><td><img class="pozslika" src="${rezul.mala_slika}"/></td><td>${rezul.cena}</td><td><input type="checkbox" value="${rezul.idProizvod}" name="cekovii" id="cekovii"/></td><td><a href="#"class="azurirajpr" data-idpro="${rezul.idProizvod}">Azuriraj proizvod</a></td><td>
    </tr>
    `
    
    
                }
                ispis+="</table>"
                $("#proizv").html(ispis);
               
            }
        })}

// prikaz korisnika u admin panelu
$("#posalji").click(function(){

  
    $.ajax({
        url:"models/korisnici/prikazkorisnika.php",
        dataType:"json",
        type:"post",
        success:function(sve){
            var rednibroj=1
            var ispis=`<table border='1' id="korisnici">
            <tr><th>Redni broj</th><th>ID Korisnika</th><th>Ime i prezime</th><th>Email</th><th>Lozinka</th><th>Pol</th><th>Uloga</th><th><input type="button" name="izkordugme" value="Izbrisi" class="izkordugme"</th><th>Azuriraj</th>
         </tr>`
            for(var prom of sve){
ispis+=` <tr><td>${rednibroj}</td><td>${prom.idkorisnik}</td><td>${prom.ime_i_prezime}</td><td>${prom.email}</td><td>${prom.lozinka}</td><td>${prom.pol}</td><td>${prom.naziv}</td><td><input type="checkbox" value="${prom.idkorisnik}" name="kor" id="kor"</td><td><a href="#" class="azuriraj"data-id="${prom.idkorisnik}">Azuriraj</a></td>
</tr>
`
rednibroj++;

            }
            ispis+="</table>"
            $("#kor").html(ispis);
        },   error:function(xhr,status,error){
            console.log(xhr,error,status)
        }
    })})

function prikaziKorisnikeBezOsvezavanja(){
    $.ajax({
        url:"models/korisnici/prikazkorisnika.php",
        dataType:"json",
        type:"post",
        success:function(sve){
            var rednibroj=1
            var ispis=`<table border='1' id="korisnici">
            <tr><th>Redni broj</th><th>ID Korisnika</th><th>Ime i prezime</th><th>Email</th><th>Lozinka</th><th>Pol</th><th>Uloga</th><th><input type="button" name="izkordugme" value="Izbrisi" class="izkordugme"</th><th>Azuriraj</th>
         </tr>`
            for(var prom of sve){
ispis+=` <tr><td>${rednibroj}</td><td>${prom.idkorisnik}</td><td>${prom.ime_i_prezime}</td><td>${prom.email}</td><td>${prom.lozinka}</td><td>${prom.pol}</td><td>${prom.naziv}</td><td><input type="checkbox" value="${prom.idkorisnik}" name="kor" id="kor"</td><td><a href="#" class="azuriraj"data-id="${prom.idkorisnik}">Azuriraj</a></td>
</tr>
`
rednibroj++;

            }
            ispis+="</table>"
            $("#kor").html(ispis);
        },   error:function(xhr,status,error){
            console.log(xhr,error,status)
        }
    })

}



//ubacivanje korisnika kroz admin panel
$("#forma").css("display","none");
$("#ubacik").click(function(){
    $("#forma").toggle()})
$("#ubacik").click(function(){
  var  ispisi=`<form name="lista" action="#" method="POST" id="ubacivanje"> 
    <input type="text" class=" finsert" name="imei" placeholder="Ime i prezime"/><br/>
    <input type="text" class="finsert" name="postai" placeholder="E-mail"/><br/>
    <input type="text" class="finsert" name="lozinkai"placeholder="Lozinka"/><br/>
    <input type="text" class="finsert" name="lozinkapi" placeholder="Lozinka Ponovo"/><br/>
    
    
  
   <select name='uloge' id='lista'>

  
        <option value='1'>Korisnik</option>
        <option value='2'>Admin</option>
       
    
    </select>
    <div id="radiobi">
    <p>Pol:</p>
 
 Muski<input type="radio" name="radi"id="rad2"class="radioi" value="Muski"/>&nbsp;
 Zenski<input type="radio" name="radi"id="rad3"class="radioi" value="Zenski"/>
 <input type="button" value="Dodaj" name="insert" id="insert"/>
</form> `

$("#forma").html(ispisi)
})
// prikaz forme za ubacivanje proizvoda
$("#prikazf").css("display","none");
$("#dodajpr").click(function(){
    $("#prikazf").toggle();})
$("#dodajpr").click(function(){
    $.ajax({
        url:"models/proizvodi/marke.php",
        dataType:"json",
        type:"post",
     
        success:function(sve){
               ispis=`<form name="prikaz" action="models/proizvodi/insertProizvoda.php" method="POST" id="popuniga"enctype="multipart/form-data" ><br/>
               <select name="marka" id="marka"><br/>`
                for(var da of sve){
                    ispis+=`  <option value="${da.idMarka}">${da.Naziv} </option>`
                }
                ispis+=`</select><br/><input type="text" placeholder="Model" id="model" name="model"/><br/>
                <textarea name="area"  id="opis" placeholder="Opis"></textarea><br/>
                <input name="userfile" type="file" id="fajl"/><br/>
                <input type="text" placeholder="Cena" name="cena" id="cena"/><br/>
                <input type="submit" name="ubacip" value="Ubaci" id="ubacip"/><br/>
                </form>`
                $("#prikazf").html(ispis)
             }
             ,error:function(xhr,status,error){
                console.log(xhr,error,status)}
            
            })})

           


 //prikaz forme proizvoda kad se azurira
 $("#proizv").on("click",".azurirajpr",function(){
    var idpro=$(this).data("idpro");
    console.log(idpro)
    $.ajax({
        url:"models/proizvodi/prikazproizvoda.php",
        dataType:"json",
        type:"post",
        data:{idpro:idpro},
        success:function(sve){
                var ispis=""
                for(var rez of sve){
                    ispis+=` <form name="azurirnjep" action="models/proizvodi/azurirajproizvod.php" method="POST" id="azuriaj"enctype="multipart/form-data"> 

                    <input type="hidden"  name="skriveno" value="${rez.idProizvod}"/><br/>
                    <input type="text" class=" finsert" name="model" value="${rez.Model}"/><br/>
                    <textarea name="area" value="${rez.Opis}">${rez.Opis}</textarea><br/>
                    <input name="userfile" type="file" value="${rez.idslika}"/><img src="${rez.mala_slika}" class="slazuriranje"/>
                    <br/>
                    
                    <input type="text" class="finsert" name="cenaa"  value="${rez.cena}"/><br/>
                    <select name='marka' id='marka'>"`
                    if(rez.Naziv=="Samsung"){
                        ispis+=`<option value='${rez.idMarka}'>${rez.Naziv}</option>
                        <option value='4'>Xiaomi</option>
                        <option value='5'>Huawei</option>`

                    } 
                    if(rez.Naziv=="Xiaomi"){
                        ispis+=`<option value='${rez.idMarka}'>${rez.Naziv}</option>
                        <option value='1'>Xiaomi</option>
                        <option value='5'>Huawei</option>`

                    }  if(rez.Naziv=="Huawei"){
                        ispis+=`<option value='${rez.idMarka}'>${rez.Naziv}</option>
                        <option value='1'>Xiaomi</option>
                        <option value='4'>Huawei</option>`

                    }
                    ispis+=`</select><input type="submit" name="azurirajpr" value="azuriraj"/>`;
                    
                }document.getElementById("pr").innerHTML=ispis;
        },error:function(xhr,status,error){
            console.log(xhr,error,status)}
})})   
   
// Brisanje korisnika!
$("#kprikaz").click(function(){
    $("#ispiss").toggle()


})
$("#kor").css("display","none");
$("#posalji").click(function(){

    $("#kor").toggle();})
$("#kor").on("click",".izkordugme",function(){
 let cekirani=$("input[name='kor']:checked");
 let niz=[];
 for(var a of cekirani){
niz.push(a.value);
 }



    var ids=$(this).data('id')
console.log(ids);
    $.ajax({


url:"models/korisnici/deletekorisnika.php",
method:"post",
dataType:"json",
data:{

    niz:niz
},
success:function(podaci){
  
 prikaziKorisnikeBezOsvezavanja()
 
},
error:function(xhr,error,status){
    console.log(xhr,status,error)
 
}
})
}) 
  // brisanje proizvoda
  $("#proizv").on("click",".izdugme",function(){
  var cekovi=$("input[name='cekovii']:checked");
  let niz=[];
  for(var a of cekovi){
      niz.push(a.value);
      console.log(niz)
  }
    $.ajax({
    
  
        url:"models/proizvodi/deleteproizvoda.php",
        method:"post",
        dataType:"json",
        data:{
        
            niz:niz
        },
        success:function(podaci){
         
            prikaziProizvodPromena();
        },
        error:function(xhr,error,status){
            console.log(xhr,status,error)
         
        }
        })
})
//dodavanje korisnika
$("#forma").on("click","#insert",function(){
    
    var formareg00=document.getElementsByClassName("finsert")[0].value
    var formareg11=document.getElementsByClassName("finsert")[1].value
    var formareg22=document.getElementsByClassName("finsert")[2].value
    var formareg33=document.getElementsByClassName("finsert")[3].value
    var formareg0=document.getElementsByClassName("finsert")[0]
    var formareg1=document.getElementsByClassName("finsert")[1]
    var formareg2=document.getElementsByClassName("finsert")[2]
    var formareg3=document.getElementsByClassName("finsert")[3]
    var reformareg0 = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,9}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,14})+$/;
    var reformareg1 = /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
    var reformareg2=/[A-z]+[0-9]+/;
    var lista=document.getElementById("lista");
        var greske=new Array();
     
        var dobro=new Array();
       if(formareg0.value==""){
        greske.push("Ime i prezime je obavezno!");formareg0.style.borderColor="red"}
        else if(!reformareg0.test(formareg0.value))
        {  greske.push("Greska - ime i prezime!");
            formareg0.style.borderColor="red"    }
        
        else 
        {      
            formareg0.style.borderColor=""  
        }
        if(formareg2.value==""){
            greske.push("Lozinka je obavezna!");formareg2.style.borderColor="red"}
        else if(!reformareg2.test(formareg2.value))
        {
            greske.push("Greska - Lozinka");
            formareg2.style.borderColor="red"}
        else
        {  
            formareg2.style.borderColor=""}
        if(formareg3.value!=formareg2.value)
        {
            greske.push("Greska - Lozinka Ponovo");
            formareg3.style.borderColor="red"
        }
        else
        { 
            formareg3.style.borderColor=""
        }
        var x=lista.options[lista.selectedIndex].value
        console.log(x)
        var rr=document.getElementsByClassName("radioi")
        var marker=false
        for(var i=0;i<rr.length
            ;i++){
                if(rr[i].checked){
                    marker=true
                    var radiob=rr[i].value;
                    break;
                }
            }
        if(marker==false){
            greske.push("Greska - Niste izabrali pol");
        }
        if(greske.length==0)
        
        {
            $.ajax({
            url:"models/korisnici/proveraIunosKorisnika.php",
            type:"post",
                dataType:"json",
        
        data:{
            imei:formareg00,
           postai:formareg11,
           lozinkai:formareg22,
          lozinkapi:formareg33,
         radi:radiob,
         lista:x
      
        },
        success:function(data,xhr){
            alert("Dodali ste nalog!")
            prikaziKorisnikeBezOsvezavanja();
          
        },
        error:function(xhr,error,status){
            console.log(xhr,status,error)
    var poruka="Doslo je do greske";
    switch(xhr.status){
        case 404:
        poruka="Stranica ne postoji!";
        break;
        case 409:
        poruka="Email vec postoji!";
        break;
     }}})}})  
    // kontakt validacija 
   $("#sub").click(function(){
        console.log("aa")
var email=document.getElementById("emailkk").value;
var naslov=document.getElementById("naslov").value;
var pitanja=document.getElementById("pitanja").value;
var remejl=/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
var renaslov=/^[A-z]+(\s[A-z]*)*$/;
var repitanje=/^[A-z]+(\s[A-z]*)*$/;
var greska=new Array();

    if(!renaslov.test(naslov)){
        greska.push("Naslov je obavezan")
    $("#naslov").css("border-color","red")
	}
	else{$("#naslov").css("border-color","")}

  if(!remejl.test(email)){
greska.push("Email je obavezan")
 $("#emailkk").css("border-color","red")
}
else{$("#emailkk").css("border-color","")}
  if(!repitanje.test(pitanja)){
	   $("#pitanja").css("border-color","red")
	   
        greska.push("Pitanje je obavezno")
        }
		else{$("#pitanja").css("border-color","")}
if(greska.length==0){
    $.ajax({
        url:"models/kontaktobrada.php",
        
        type:"post",
        data:{emeil:email,naslov:naslov,pitanja:pitanja},
        success:function(sve){
            alert("Poruka poslata administratoru!");
        },error:function(xhr,error,status){console.log(xhr,error,status)}
    })
}
   })

//rezultati ankete
$("#rezan").css("display","none");
$("#rezultat").click(function(){
    $("#rezan").toggle();})
    $("#rezultat").click(function(){
    $.ajax({
        url:"models/rezultatiAnkete.php",
        dataType:"json",
        type:"post",
        success:function(sve){
            var ispis="<table id='anketaodgovor' border='1px solid black'><tr><td>Rezultati ankete</td></tr>";
            for(var red of sve){
                ispis+=`<tr><td>${red.odgovori}</td><td>${red.rezultat}</td></tr>`
            }
            ispis+="</table>";
            $("#rezan").html(ispis);
}
,error:function(xhr,error,status){console.log(xhr,error,status)}
})})
// prikaz porudzbina
$("#prikazp").css("display","none");
$("#trazikorpa").css("display","none");
$("#porudzbine").click(function(){
   
$("#prikazp").toggle();
$("#trazikorpa").toggle();
})
// porudzbine prikaz 
$("#porudzbine").click(function(){

  
    $.ajax({
        url:"models/proizvodi/porudzbine.php",
        dataType:"json",
        type:"post",
        success:function(sve){
           ispisiporudzbine(sve);


        },error:function(xhr,error,status){
            console.log(xhr,status,error)}
    
    
    })})

function ispisiporudzbine(sve){
   
   var ispis=`<table border="1px" id="tabelapo"><tr><td>ID porudzbine</td><td>ID korisnika</td><td>Ime i prezime</td><td>ID proizvoda</td><td>Model</td><td>Marka</td><td>Kolicina</td><td>Cena</td><td>Vreme porudzbine</td><td><input type="button" value="Izbrisi" id="korpbrisi"</td></tr>`
        for(var a of sve){
            ispis+=`<tr><td>${a.idkorpa}</td><td>${a.idkorisnik}</td><td>${a.ime_i_prezime}</td><td>${a.idProizvod}</td><td>${a.Model}</td><td>${a.Naziv}</td><td>${a.kolicina}</td><td>${a.cena}</td><td>${a.Vreme}</td><td><input type="checkbox" value="${a.idkorpa}" name="korpabox"</td>`
        }
        ispis+=`</table>`;
        $("#prikazp").html(ispis);
        $("#tabelapo tr:even").css('background-color','#9090904f');
}

// trazi porudzbine
$("#trazikorpa").keyup(function(){
var vrednost=this.value

    $.ajax({
        url:"models/korpa/traziKorpa.php",
        dataType:"json",
        type:"post",
        data:{vrednost:vrednost},
        success:function(sve){
           ispisiporudzbine(sve);


        },error:function(xhr,error,status){
            console.log(xhr,status,error)}
    
    
    })
})

    function prikaziPorudzbine(){
        $.ajax({
            url:"models/proizvodi/porudzbine.php",
            dataType:"json",
            type:"post",
            success:function(sve){
                var ispis=`<table border="1px" id="tabelapo"><tr><td>ID porudzbine</td><td>ID korisnika</td><td>Ime i prezime</td><td>ID proizvoda</td><td>Naziv proizvoda</td><td>Model</td><td>Marka</td><td>Kolicina</td><td>Cena</td><td>Vreme porudzbine</td><td><input type="button" value="Izbrisi" id="korpbrisi"</td></tr>`
                for(var a of sve){
                    ispis+=`<tr><td>${a.idkorpa}</td><td>${a.idkorisnik}</td><td>${a.ime_i_prezime}</td><td>${a.idProizvod}</td><td>${a.Model}</td><td>${a.Model}</td><td>${a.Naziv}</td><td>${a.kolicina}</td><td>${a.cena}</td><td>${a.Vreme}</td><td><input type="checkbox" value="${a.idkorpa}" name="korpabox"</td>`
                }
                ispis+=`</table>`;
                $("#prikazp").html(ispis);
                $("#tabelapo tr:even").css('background-color','#9090904f');
    
    
            },error:function(xhr,error,status){
                console.log(xhr,status,error)}
        
        
        })
    }
    $("#prikazp").on("click","#korpbrisi",function(){
        var cekirani=$("input[name='korpabox']:checked");
        niz=[];
        for(var a of cekirani){
            niz.push(a.value)
        }
        $.ajax({
            url:"models/korpa/izbrisiizkorpe.php",
            dataType:"json",
            type:"post",
            data:{niz:niz},
            success:function(sve){
                prikaziPorudzbine()




            },error:function(xhr,error,status){
                console.log(xhr,status,error)}
        
        
        })})

//vreme pristupa
$("#chartContainer").css("display","none");

$("#statistika").click(function(){
   
$("#chartContainer").toggle();})
//statistika dijagram
$("#prikazfajl").css("display","none");

$("#vremep").click(function(){
   
$("#prikazfajl").toggle();})
// broj pristupa stranica i aktivnosti
$("#prikazbroj").css("display","none");

$("#brojpristupa").click(function(){
   console.log("a")
$("#prikazbroj").toggle();})})
$(document).ready(function(){
    slideShow();
  });
  function slideShow() {
    var trenutni = $('#slajder .aktivna');
    var next = trenutni.next().length ? trenutni.next() :trenutni.parent().children(':first');
    
    trenutni.hide().removeClass('aktivna');
    next.fadeIn().addClass('aktivna');
    
    setTimeout(slideShow, 4000);
  }
$("#sdesno").click(function(){
    var trenutni=$("#slajder .aktivna");
    var sledeci= trenutni.next().length?trenutni.next():trenutni.parent().children(":first");
    trenutni.hide().removeClass("aktivna");
    sledeci.fadeIn().addClass("aktivna");
})
$("#slevo").click(function(){
    var trenutni=$("#slajder .aktivna");
    var sledeci= trenutni.prev().length?trenutni.prev():trenutni.parent().children(":last");
    trenutni.hide().removeClass("aktivna");
    sledeci.fadeIn().addClass("aktivna");


})

$(document).ready(function(){
  
    $("#btnMeni").click(function(){
        $("#nav ul").slideToggle()
        
        
    })	
   
    $("#meni ul li").hover(function(){
            
        $(this).animate({backgroundColor:"rgb(117, 99, 99) "},"slow")
    
    },function(){
        $(this).animate({backgroundColor:"#424040"},"slow")
     
    })

        $("#nav ul li").hover(function(){
        
            $(this).animate({backgroundColor:"rgb(132, 132, 132)"},"slow")
        
        },function(){
            $(this).animate({backgroundColor:"#424040"},"slow")})
      
         })
