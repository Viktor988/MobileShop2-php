$("#dugprijava2").click(function(){
  var greske=0;
var reformareg0 =  /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
var email2=document.getElementById("pprvi").value
var sifra2=document.getElementById("ddrugi").value
var email=document.getElementById("pprvi")
var sifra=document.getElementById("ddrugi")
var tekst=document.getElementById("prijavap")
var dugprijava2=document.getElementById("dugprijava2")
var tekst2=document.getElementById("prijavad")
var relozinka=/[A-z]+[0-9]+/;
document.getElementById("ddrugi").style.display="block";
if(email2==""){
tekst.innerHTML="Niste uneli E-mail!"
email.style.borderColor="red";     greske=1;
dugprijava2.style.Top="270px";}
else if(!reformareg0.test(email.value)){
email.style.borderColor="red"
tekst.innerHTML="E-mail nije u dobrom formatu!";    greske=1;
}
else{
    email.style.borderColor=""
    tekst.innerHTML="" 
    greske=0;
}
    if(sifra2==""){
        tekst2.innerHTML="Niste uneli lozinku!"
       sifra.style.borderColor="red";    greske=1;
       dugprijava2.style.Top="270px"} 
    else if(!relozinka.test(sifra2)){
    sifra.style.borderColor="red"
    tekst2.innerHTML="Lozinka nije u dobrom formatu!";    greske=1;
    }
    else{
        sifra.style.borderColor=""
        tekst2.innerHTML="" 
        $greske=0;
}
   if(greske==0){
    $.ajax({
        url:"models/proveralogin.php",
     
        type:"post",
        data:{
        email2:email2,sifra2:sifra2},
        success:function(sve){
            window.location.replace("http://localhost/sajtzaphppraktikum1/index.php?page=pocetna");
            console.log(sve)
        }, error:function(xhr,status,error){
           alert("Prvo se morate registrovati");
           window.location.replace("http://localhost/sajtzaphppraktikum1/index.php?page=pocetna")
           console.log(xhr,status,error)
        }
})
   }
})


    $(".fa-eye-slash").click(function(){
        $("#ddrugi").attr('type', 'text');
        $(this).css("display","none");
        $("#oko2").css("display","block");
        })
        
        $("#oko2").click(function(){
            $("#ddrugi").attr('type', 'password');
          
            $(this).css("display","none");
            $("#oko").css("display","block");
            })