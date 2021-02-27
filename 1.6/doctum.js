

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Bmatovu" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu.html">Bmatovu</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_MtnMomo" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo.html">MtnMomo</a></div><div class="bd"><ul><li data-name="namespace:Bmatovu_MtnMomo_Console" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Console.html">Console</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Console_BootstrapCommand" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Console/BootstrapCommand.html">BootstrapCommand</a></div></li><li data-name="class:Bmatovu_MtnMomo_Console_RegisterIdCommand" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Console/RegisterIdCommand.html">RegisterIdCommand</a></div></li><li data-name="class:Bmatovu_MtnMomo_Console_RequestSecretCommand" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Console/RequestSecretCommand.html">RequestSecretCommand</a></div></li><li data-name="class:Bmatovu_MtnMomo_Console_ValidateIdCommand" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Console/ValidateIdCommand.html">ValidateIdCommand</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_MtnMomo_Exceptions" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Exceptions.html">Exceptions</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Exceptions_CollectionRequestException" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Exceptions/CollectionRequestException.html">CollectionRequestException</a></div></li><li data-name="class:Bmatovu_MtnMomo_Exceptions_DisbursementRequestException" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Exceptions/DisbursementRequestException.html">DisbursementRequestException</a></div></li><li data-name="class:Bmatovu_MtnMomo_Exceptions_RemittanceRequestException" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Exceptions/RemittanceRequestException.html">RemittanceRequestException</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_MtnMomo_Models" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Models.html">Models</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Models_Token" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Models/Token.html">Token</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_MtnMomo_Products" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Products.html">Products</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Products_Collection" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Products/Collection.html">Collection</a></div></li><li data-name="class:Bmatovu_MtnMomo_Products_Disbursement" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Products/Disbursement.html">Disbursement</a></div></li><li data-name="class:Bmatovu_MtnMomo_Products_Product" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Products/Product.html">Product</a></div></li><li data-name="class:Bmatovu_MtnMomo_Products_Remittance" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Products/Remittance.html">Remittance</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_MtnMomo_Repositories" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Repositories.html">Repositories</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Repositories_TokenRepository" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Repositories/TokenRepository.html">TokenRepository</a></div></li></ul></div></li><li data-name="namespace:Bmatovu_MtnMomo_Traits" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Bmatovu/MtnMomo/Traits.html">Traits</a></div><div class="bd"><ul><li data-name="class:Bmatovu_MtnMomo_Traits_CommandUtilTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Traits/CommandUtilTrait.html">CommandUtilTrait</a></div></li><li data-name="class:Bmatovu_MtnMomo_Traits_TokenUtilTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Bmatovu/MtnMomo/Traits/TokenUtilTrait.html">TokenUtilTrait</a></div></li></ul></div></li><li data-name="class:Bmatovu_MtnMomo_MtnMomoServiceProvider" ><div style="padding-left:44px" class="hd leaf"><a href="Bmatovu/MtnMomo/MtnMomoServiceProvider.html">MtnMomoServiceProvider</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Bmatovu.html","name":"Bmatovu","doc":"Namespace Bmatovu"},{"type":"Namespace","link":"Bmatovu/MtnMomo.html","name":"Bmatovu\\MtnMomo","doc":"Namespace Bmatovu\\MtnMomo"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Console.html","name":"Bmatovu\\MtnMomo\\Console","doc":"Namespace Bmatovu\\MtnMomo\\Console"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Exceptions.html","name":"Bmatovu\\MtnMomo\\Exceptions","doc":"Namespace Bmatovu\\MtnMomo\\Exceptions"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Models.html","name":"Bmatovu\\MtnMomo\\Models","doc":"Namespace Bmatovu\\MtnMomo\\Models"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Products.html","name":"Bmatovu\\MtnMomo\\Products","doc":"Namespace Bmatovu\\MtnMomo\\Products"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Repositories.html","name":"Bmatovu\\MtnMomo\\Repositories","doc":"Namespace Bmatovu\\MtnMomo\\Repositories"},{"type":"Namespace","link":"Bmatovu/MtnMomo/Traits.html","name":"Bmatovu\\MtnMomo\\Traits","doc":"Namespace Bmatovu\\MtnMomo\\Traits"},                                                        {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Console","fromLink":"Bmatovu/MtnMomo/Console.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","doc":"Bootstrap integration."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method___construct","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::__construct","doc":"Create a new command instance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_handle","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::handle","doc":"Execute the console command."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_setClientName","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::setClientName","doc":"Create/update client APP name."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_setEnvironment","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::setEnvironment","doc":"Create/update target environment."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_setCurrency","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::setCurrency","doc":"Create/update currency."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_setProductName","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::setProductName","doc":"Create/update target product subscribed too."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand","fromLink":"Bmatovu/MtnMomo/Console/BootstrapCommand.html","link":"Bmatovu/MtnMomo/Console/BootstrapCommand.html#method_setProductSubscriptionKey","name":"Bmatovu\\MtnMomo\\Console\\BootstrapCommand::setProductSubscriptionKey","doc":"Create/update product subscription key."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Console","fromLink":"Bmatovu/MtnMomo/Console.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","doc":"Register client ID in sandbox environment."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","fromLink":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html#method___construct","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand::__construct","doc":"Create a new command instance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","fromLink":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html#method_handle","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand::handle","doc":"Execute the console command."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","fromLink":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html#method_getClientId","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand::getClientId","doc":"Determine client ID."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","fromLink":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html#method_getClientRedirectUri","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand::getClientRedirectUri","doc":"Determine client redirect URI."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand","fromLink":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html","link":"Bmatovu/MtnMomo/Console/RegisterIdCommand.html#method_registerClientId","name":"Bmatovu\\MtnMomo\\Console\\RegisterIdCommand::registerClientId","doc":"Register client ID."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Console","fromLink":"Bmatovu/MtnMomo/Console.html","link":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html","name":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand","doc":"Request client app secret."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand","fromLink":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html","link":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html#method___construct","name":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand::__construct","doc":"Create a new command instance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand","fromLink":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html","link":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html#method_handle","name":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand::handle","doc":"Execute the console command."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand","fromLink":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html","link":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html#method_getClientId","name":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand::getClientId","doc":"Determine client ID."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand","fromLink":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html","link":"Bmatovu/MtnMomo/Console/RequestSecretCommand.html#method_requestClientSecret","name":"Bmatovu\\MtnMomo\\Console\\RequestSecretCommand::requestClientSecret","doc":"Request for client APP secret."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Console","fromLink":"Bmatovu/MtnMomo/Console.html","link":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html","name":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand","doc":"Get client APP API credentials."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand","fromLink":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html","link":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html#method___construct","name":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand::__construct","doc":"Create a new command instance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand","fromLink":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html","link":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html#method_handle","name":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand::handle","doc":"Execute the console command."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand","fromLink":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html","link":"Bmatovu/MtnMomo/Console/ValidateIdCommand.html#method_requestClientInfo","name":"Bmatovu\\MtnMomo\\Console\\ValidateIdCommand::requestClientInfo","doc":"Request client credentials."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Exceptions","fromLink":"Bmatovu/MtnMomo/Exceptions.html","link":"Bmatovu/MtnMomo/Exceptions/CollectionRequestException.html","name":"Bmatovu\\MtnMomo\\Exceptions\\CollectionRequestException","doc":"Custom collection request exception."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Exceptions\\CollectionRequestException","fromLink":"Bmatovu/MtnMomo/Exceptions/CollectionRequestException.html","link":"Bmatovu/MtnMomo/Exceptions/CollectionRequestException.html#method___construct","name":"Bmatovu\\MtnMomo\\Exceptions\\CollectionRequestException::__construct","doc":"Constructor."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Exceptions","fromLink":"Bmatovu/MtnMomo/Exceptions.html","link":"Bmatovu/MtnMomo/Exceptions/DisbursementRequestException.html","name":"Bmatovu\\MtnMomo\\Exceptions\\DisbursementRequestException","doc":"Custom disbursement request exception."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Exceptions\\DisbursementRequestException","fromLink":"Bmatovu/MtnMomo/Exceptions/DisbursementRequestException.html","link":"Bmatovu/MtnMomo/Exceptions/DisbursementRequestException.html#method___construct","name":"Bmatovu\\MtnMomo\\Exceptions\\DisbursementRequestException::__construct","doc":"Constructor."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Exceptions","fromLink":"Bmatovu/MtnMomo/Exceptions.html","link":"Bmatovu/MtnMomo/Exceptions/RemittanceRequestException.html","name":"Bmatovu\\MtnMomo\\Exceptions\\RemittanceRequestException","doc":"Custom remittance request exception."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Exceptions\\RemittanceRequestException","fromLink":"Bmatovu/MtnMomo/Exceptions/RemittanceRequestException.html","link":"Bmatovu/MtnMomo/Exceptions/RemittanceRequestException.html#method___construct","name":"Bmatovu\\MtnMomo\\Exceptions\\RemittanceRequestException::__construct","doc":"Constructor."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Models","fromLink":"Bmatovu/MtnMomo/Models.html","link":"Bmatovu/MtnMomo/Models/Token.html","name":"Bmatovu\\MtnMomo\\Models\\Token","doc":"Token model."},
                
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo","fromLink":"Bmatovu/MtnMomo.html","link":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html","name":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider","doc":"Package service provider."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider","fromLink":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html","link":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html#method_boot","name":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider::boot","doc":"Bootstrap the application services."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider","fromLink":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html","link":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html#method_register","name":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider::register","doc":"Register the application services."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider","fromLink":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html","link":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html#method_commandClient","name":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider::commandClient","doc":"Create command's concrete client."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider","fromLink":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html","link":"Bmatovu/MtnMomo/MtnMomoServiceProvider.html#method_getLogMiddleware","name":"Bmatovu\\MtnMomo\\MtnMomoServiceProvider::getLogMiddleware","doc":"Get log middleware."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Products","fromLink":"Bmatovu/MtnMomo/Products.html","link":"Bmatovu/MtnMomo/Products/Collection.html","name":"Bmatovu\\MtnMomo\\Products\\Collection","doc":"Collection service/product."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::getTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_setTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::setTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::getTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_setTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::setTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::getAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_setAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::setAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getAppAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::getAppAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_setAppAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Collection::setAppAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method___construct","name":"Bmatovu\\MtnMomo\\Products\\Collection::__construct","doc":"Constructor."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_transact","name":"Bmatovu\\MtnMomo\\Products\\Collection::transact","doc":"Request payee to pay."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getTransactionStatus","name":"Bmatovu\\MtnMomo\\Products\\Collection::getTransactionStatus","doc":"Get transaction status."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getToken","name":"Bmatovu\\MtnMomo\\Products\\Collection::getToken","doc":"Request collections access token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_getAccountBalance","name":"Bmatovu\\MtnMomo\\Products\\Collection::getAccountBalance","doc":"Get account balance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Collection","fromLink":"Bmatovu/MtnMomo/Products/Collection.html","link":"Bmatovu/MtnMomo/Products/Collection.html#method_isActive","name":"Bmatovu\\MtnMomo\\Products\\Collection::isActive","doc":"Determine if an account holder is registered and active."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Products","fromLink":"Bmatovu/MtnMomo/Products.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html","name":"Bmatovu\\MtnMomo\\Products\\Disbursement","doc":"Class Disbursement."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_setTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::setTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_setTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::setTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_setAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::setAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_setAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::setAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method___construct","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::__construct","doc":"Disbursement constructor."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getToken","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getToken","doc":"Request disbursement access token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_transfer","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::transfer","doc":"Transfer an amount to a payee account."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getDisbursementTransactionStatus","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getDisbursementTransactionStatus","doc":"Get transaction status."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_getAccountBalance","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::getAccountBalance","doc":"Get account balance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Disbursement","fromLink":"Bmatovu/MtnMomo/Products/Disbursement.html","link":"Bmatovu/MtnMomo/Products/Disbursement.html#method_isActive","name":"Bmatovu\\MtnMomo\\Products\\Disbursement::isActive","doc":"Determine if an account holder is registered and active."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Products","fromLink":"Bmatovu/MtnMomo/Products.html","link":"Bmatovu/MtnMomo/Products/Product.html","name":"Bmatovu\\MtnMomo\\Products\\Product","doc":"Generic product/service."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getClient","name":"Bmatovu\\MtnMomo\\Products\\Product::getClient","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setClient","name":"Bmatovu\\MtnMomo\\Products\\Product::setClient","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getBaseUri","name":"Bmatovu\\MtnMomo\\Products\\Product::getBaseUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setBaseUri","name":"Bmatovu\\MtnMomo\\Products\\Product::setBaseUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getTokenUri","name":"Bmatovu\\MtnMomo\\Products\\Product::getTokenUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setTokenUri","name":"Bmatovu\\MtnMomo\\Products\\Product::setTokenUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getSubscriptionKey","name":"Bmatovu\\MtnMomo\\Products\\Product::getSubscriptionKey","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setSubscriptionKey","name":"Bmatovu\\MtnMomo\\Products\\Product::setSubscriptionKey","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getClientId","name":"Bmatovu\\MtnMomo\\Products\\Product::getClientId","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setClientId","name":"Bmatovu\\MtnMomo\\Products\\Product::setClientId","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getClientSecret","name":"Bmatovu\\MtnMomo\\Products\\Product::getClientSecret","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setClientSecret","name":"Bmatovu\\MtnMomo\\Products\\Product::setClientSecret","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getClientRedirectUri","name":"Bmatovu\\MtnMomo\\Products\\Product::getClientRedirectUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setClientRedirectUri","name":"Bmatovu\\MtnMomo\\Products\\Product::setClientRedirectUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getCurrency","name":"Bmatovu\\MtnMomo\\Products\\Product::getCurrency","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setCurrency","name":"Bmatovu\\MtnMomo\\Products\\Product::setCurrency","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getEnvironment","name":"Bmatovu\\MtnMomo\\Products\\Product::getEnvironment","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setEnvironment","name":"Bmatovu\\MtnMomo\\Products\\Product::setEnvironment","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getPartyIdType","name":"Bmatovu\\MtnMomo\\Products\\Product::getPartyIdType","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setPartyIdType","name":"Bmatovu\\MtnMomo\\Products\\Product::setPartyIdType","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getLogFile","name":"Bmatovu\\MtnMomo\\Products\\Product::getLogFile","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_setLogFile","name":"Bmatovu\\MtnMomo\\Products\\Product::setLogFile","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method___construct","name":"Bmatovu\\MtnMomo\\Products\\Product::__construct","doc":"Constructor."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getToken","name":"Bmatovu\\MtnMomo\\Products\\Product::getToken","doc":"Request access token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getLogMiddleware","name":"Bmatovu\\MtnMomo\\Products\\Product::getLogMiddleware","doc":"Get log middleware."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Product","fromLink":"Bmatovu/MtnMomo/Products/Product.html","link":"Bmatovu/MtnMomo/Products/Product.html#method_getAuthBroker","name":"Bmatovu\\MtnMomo\\Products\\Product::getAuthBroker","doc":"Get authentication broker."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Products","fromLink":"Bmatovu/MtnMomo/Products.html","link":"Bmatovu/MtnMomo/Products/Remittance.html","name":"Bmatovu\\MtnMomo\\Products\\Remittance","doc":"Remittance service/product."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_setTransactionUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::setTransactionUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_setTransactionStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::setTransactionStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_setAccountStatusUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::setAccountStatusUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_setAccountBalanceUri","name":"Bmatovu\\MtnMomo\\Products\\Remittance::setAccountBalanceUri","doc":""},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method___construct","name":"Bmatovu\\MtnMomo\\Products\\Remittance::__construct","doc":"Constructor."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getToken","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getToken","doc":"Request remittance access token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_transact","name":"Bmatovu\\MtnMomo\\Products\\Remittance::transact","doc":"Transfer from your own account to another person's account."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_transfer","name":"Bmatovu\\MtnMomo\\Products\\Remittance::transfer","doc":"Transfer from your own account to another person's account."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getTransactionStatus","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getTransactionStatus","doc":"Get transaction status."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_getAccountBalance","name":"Bmatovu\\MtnMomo\\Products\\Remittance::getAccountBalance","doc":"Get account balance."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Products\\Remittance","fromLink":"Bmatovu/MtnMomo/Products/Remittance.html","link":"Bmatovu/MtnMomo/Products/Remittance.html#method_isActive","name":"Bmatovu\\MtnMomo\\Products\\Remittance::isActive","doc":"Determine if an account holder is registered and active."},
            
                                                {"type":"Class","fromName":"Bmatovu\\MtnMomo\\Repositories","fromLink":"Bmatovu/MtnMomo/Repositories.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","doc":"Token repository."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method___constructor","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::__constructor","doc":"Constructor."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method_create","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::create","doc":"{@inheritdoc}"},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method_retrieveAll","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::retrieveAll","doc":"{@inheritdoc}"},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method_retrieve","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::retrieve","doc":"{@inheritdoc}"},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method_update","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::update","doc":"{@inheritdoc}"},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository","fromLink":"Bmatovu/MtnMomo/Repositories/TokenRepository.html","link":"Bmatovu/MtnMomo/Repositories/TokenRepository.html#method_delete","name":"Bmatovu\\MtnMomo\\Repositories\\TokenRepository::delete","doc":"{@inheritdoc}"},
            
                                                {"type":"Trait","fromName":"Bmatovu\\MtnMomo\\Traits","fromLink":"Bmatovu/MtnMomo/Traits.html","link":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html","name":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait","doc":"Console commands utilities."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html#method_runInProduction","name":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait::runInProduction","doc":"Warn user running command in production."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html#method_printLabels","name":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait::printLabels","doc":"Print formatted labels."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html#method_getRegex","name":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait::getRegex","doc":"Determine replacement regex pattern a setting."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/CommandUtilTrait.html#method_updateSetting","name":"Bmatovu\\MtnMomo\\Traits\\CommandUtilTrait::updateSetting","doc":"Write | replace setting in .env file."},
            
                                                {"type":"Trait","fromName":"Bmatovu\\MtnMomo\\Traits","fromLink":"Bmatovu/MtnMomo/Traits.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","doc":"Token model utilities."},
                                {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html#method_getAccessToken","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait::getAccessToken","doc":"Get access token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html#method_getRefreshToken","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait::getRefreshToken","doc":"Get refresh token."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html#method_getTokenType","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait::getTokenType","doc":"Get token type."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html#method_getExpiresAt","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait::getExpiresAt","doc":"Get expires at."},
        {"type":"Method","fromName":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait","fromLink":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html","link":"Bmatovu/MtnMomo/Traits/TokenUtilTrait.html#method_isExpired","name":"Bmatovu\\MtnMomo\\Traits\\TokenUtilTrait::isExpired","doc":"Determine if a token is expired."},
            
                                // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

        // Enable the version switcher
    $('#version-switcher').on('change', function() {
        window.location = $(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version="1.6"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


