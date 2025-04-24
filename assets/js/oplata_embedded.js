

/* !!! Ch Log !!! S  */
/*
document.addEventListener("DOMContentLoaded", () => oplata("#oplata-checkout-container", oplataPaymentArguments));
*/



  const initOplataWidget = () => hutko("#oplata-checkout-container", oplataPaymentArguments);

    if (document.getElementById('oplata_script') == null) {
        let oplataScript = document.createElement('script');
        oplataScript.src = 'https://pay.hutko.org/latest/checkout-vue/checkout.js';
        oplataScript.id = 'oplata_script'
        oplataScript.onload = initOplataWidget;
        document.head.appendChild(oplataScript);

        console.log(" oplataScript : ", oplataScript);
    } else initOplataWidget();

   // console.log(" oplataPaymentArguments : ", oplataPaymentArguments);


/* !!! Ch Log !!! E  */