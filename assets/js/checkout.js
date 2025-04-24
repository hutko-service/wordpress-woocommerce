const fg_settings = window.wc.wcSettings.getSetting( 'hutko_data', {} );

const fg_label = window.wp.htmlEntities.decodeEntities( fg_settings.title ) || window.wp.i18n.__( 'hutko Gateway', 'hutko' );
const fg_Content = () => {
    return window.wp.htmlEntities.decodeEntities( fg_settings.description || '' );
};
const Hutko_Payment_Block_Gateway = {
    name: 'hutko',
    label: fg_label,
    content: Object( window.wp.element.createElement )( fg_Content, null ),
    edit: Object( window.wp.element.createElement )( fg_Content, null ),
    canMakePayment: () => true,
    ariaLabel: fg_label,
    supports: {
        features: fg_settings.supports,
    },
};
window.wc.wcBlocksRegistry.registerPaymentMethod( Hutko_Payment_Block_Gateway );