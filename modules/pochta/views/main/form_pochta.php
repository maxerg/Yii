<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отправка</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

    <div class="flex_in">
        <div class="popup__inner">
            <div class="popup__header">
                <h1 class="popup__title">
                    <!----><span ng-if="!backlog.barcode">Новое отправление</span><!---->
                    <!---->
                </h1>
                <!---->
                <!---->
                <!---->
            </div>
            <div class="popup__body">
                <div class="popup__mailing-form">
                    <form class="form form--v2 mailing-form ng-pristine ng-valid-min ng-valid-max ng-valid-pattern ng-valid-maxlength ng-invalid ng-invalid-required" name="shipmentForm">
                        <!-- from this -->

                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!----><!----><ng-include src="'static/views/components/shipment/parcel.html'" ng-if="!helper.isLetterProduct(backlog) &amp;&amp; !helper.isECOM(backlog) &amp;&amp; !helper.allowDeliveryType(backlog) &amp;&amp; !utils.isHyperLocal(backlog)"><div class="row">
                                <div class="input input--select input--select-open" ng-class="fieldClass()" id="dropdown-86">

                                    <label class="input__title" ng-show="label">
                                        Отделение для отправки
                                        <!---->
                                    </label>

                                    <div class="input__field-wrap clicked" ng-class="{ 'clicked': listVisible }">
                                        <input type="text" name="postOfficeCode" class="input__field" value="" ng-focus="show($event)" ng-blur="hide($event)" ng-required="fieldRequired" no-valid-message="" required="required">

                                        <script>
                                            var a = 0;
                                            var b = 0;
                                            var selected1 = 0;
                                            var selected2 = 0;
                                            function opens1(){
                                                if (a == 0){
                                                    a = 1;
                                                    $('.geter1_1').css({'opacity': '1','visibility': 'visible'});
                                                }else{
                                                    a = 0;
                                                      $('.geter1_1').css({'opacity': '0','visibility': 'hidden'});
                                                }
                                            }
                                            function opens11(e,id,title){
                                                    a = 0;
                                                    $('.input--select-open .input__suggest').css({'opacity': '0','visibility': 'hidden'});
                                                    $('#'+id).html(title);
                                                    if (e < 3){
                                                        selected1 = e;
                                                    }else{
                                                        selected2 = e;
                                                    }
                                            }
                                            function open2(){
                                                if (selected1 != 0){
                                                    if (b == 0){
                                                        b = 1;
                                                            $('.geter'+selected1).css({'opacity': '1','visibility': 'visible'});

                                                    }else{
                                                        b = 0;
                                                        $('.geter'+selected1).css({'opacity': '0','visibility': 'hidden'});
                                                    }
                                                }

                                            }
                                            function goes(){
                                                otdel = $('#name1').html().substr(0,6);
                                                fio_f = $('#fullName-field').val().split(' ')[0];
                                                fio_i = $('#fullName-field').val().split(' ')[1];
                                                fio_o = $('#fullName-field').val().split(' ')[2];
                                                number = $('#telephone-field').val();
                                                ves = $('#mass-field').val();
                                                type = $('#name2').html();
                                                price = $('#comment-field').val();
                                                adres = $('#suggest_94').val();
                                                iddeal = "<?php echo $iddeal;?>";

                                                var smsf;
                                                if ($('#sms-notice-recipient').is(':checked')){
                                                    smsf = 1;

                                                } else {
                                                    smsf = 0;
                                                }

                                                $.ajax({
                                                    url: 'https://studio-10.ru/template-uchet/web/pochta/send-form',
                                                    type: 'POST',
                                                    dataType: 'text',
                                                    data:{
                                                        otdel: otdel,
                                                        fio_f:fio_f,
                                                        fio_i:fio_i,
                                                        fio_o:fio_o,
                                                        number:number,
                                                        price:price,
                                                        type:type,
                                                        ves:ves,
                                                        sms:smsf,
                                                        adres:adres,
                                                        iddeal:iddeal,

                                                    },
                                                    success: function(e){
                                                        
                                                       if (e == 'Успех'){
                                                          window.location.replace("https://studio-10.ru/template-uchet/web/pochta/suc");
                                                      }else{
                                                           window.location.replace("https://studio-10.ru/template-uchet/web/pochta/err");

                                                     }
                                                    }

                                                });

                                            }
                                        </script>
                                        <div class="input__value" id="name1"  onclick="opens1()" tabindex="-1"></div>

                                        <em class="input__icon input__icon--caret-down" ng-click="show()"></em>

                                        <div class="input__suggest geter1_1" id="auto_input-suggest" style="opacity: 0; visibility: hidden;">
                                            <div class="input__suggest-search">
                                                <!---->
                                                <!---->
                                            </div>
                                            <div ng-class="getListClass()" >
                                                <!----><div onclick="opens11(1,'name1', '141020 - пр-кт Новомытищинский, д.д 47 А, г Мытищи, Москва')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    141020 - пр-кт Новомытищинский, д.д 47 А, г Мытищи, Москва
                                                </div><!---->
                                                <div onclick="opens11(2,'name1', '141407 - пр-кт Юбилейный, д.41, литера А, г Химки, обл Московская')"  class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    141407 - пр-кт Юбилейный, д.41, литера А, г Химки, обл Московская
                                                </div><!---->
                                            </div>
                                        </div>

                                    </div>

                                    <div class="input__note ng-hide" ng-show="note" ng-bind-html="note"></div>
                                    <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                </div>
                            <div class="row">
                                <div class="input input--select input--select-open" ng-class="fieldClass()" id="dropdown-85">

                                    <label class="input__title" ng-show="label" >
                                        Тип отправления
                                        <!---->
                                    </label>

                                    <div onclick="open2()" class="input__field-wrap clicked"  >
                                        <input  type="text" name="mailType"  class="input__field" required="required">

                                        <div  class="input__value" id="name2" ng-class="displayClass"  tabindex="-1"></div>
                                        <em  class="input__icon input__icon--caret-down" ></em>

                                        <div class="input__suggest geter1" id="auto_input-suggest" style="opacity: 0; visibility: hidden;">
                                            <div class="input__suggest-search">
                                                <!---->
                                                <!---->
                                            </div>
                                            <div ng-class="getListClass()">
                                                <div onclick="opens11(3,'name2', 'Курьер онлайн')"  class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Курьер онлайн
                                                </div><!---->
                                            <div onclick="opens11(4,'name2', 'Посылка')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Посылка
                                                </div><!---->
                                            </div>


                                        </div>


                                        <div class="input__suggest geter2" id="auto_input-suggest" style="opacity: 0; visibility: hidden;">
                                            <div class="input__suggest-search">
                                                <!---->
                                                <!---->
                                            </div>

                                            <div ng-class="getListClass()" id="geter2" >
                                                <!---->
                                                <div onclick="opens11(5,'name2', 'Мелкий пакет')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Мелкий пакет
                                                </div><!---->
                                                <div onclick="opens11(6,'name2', 'Посылка')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Посылка
                                                </div><!---->
                                                <div onclick="opens11(7,'name2', 'Посылка 1 класса')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Посылка 1 класса
                                                </div><!---->
                                                <div onclick="opens11(8,'name2', 'Посылка международная')" class="input__suggest-item" ng-repeat="item in filteredList" ng-click="select(item)" ng-class="{ 'input__suggest-item-selected': isSelected(item) }">
                                                    Посылка международная
                                                </div><!---->
                                            </div>

                                        </div>


                                    </div>

                                    <div class="input__note ng-hide" ng-show="note" ng-bind-html="note"></div>
                                    <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                </div>
                                <div class="col-12"><!----><ng-include src="'static/views/components/mass.html'"><div class="input" ng-class="fieldClass('mass')">
                                            <label for="mass-field" class="input__title mailing-form__nowrap-input">
                                                Вес в граммах c упаковкой
                                            </label>
                                            <div class="input__field-wrap">
                                                <input value="<?php echo $weight;?>" id="mass-field" type="number" name="mass" ng-model="backlog.mass" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max ng-valid-required ng-valid-pattern" ng-required="backlog.massRequired" min="" max="" placeholder="" ng-pattern="/^[0-9]+$/" delay-call="onMassChanged()" delay="500" ng-change="fieldChanged('mass')" ng-disabled="disabledFields.mass" onwheel="this.blur()" no-valid-message="">
                                            </div>
                                            <!---->
                                            <!---->
                                            <!---->
                                            <!---->
                                            <!---->
                                        </div>
                                    </ng-include></div>
                            </div>

                            <div class="row">
                                <!---->

                                <!---->
                            </div>

                                <div class="col-12"><!----><ng-include src="'static/views/components/tel-address.html'"><!----><addressbook ng-if="settings.addressBookEnabled" field-id="telephone-field" name="telAddress" placeholder="+X-XXX-XXX-XX-XX" suggest-type="phone" suggest-tooltip="Найдены совпадения" suggest-delete="Удалить из адресной книги" autofill-item="abControl.lastSavedAddress" format-phone="!settings.rawTelAddressEnabled" label="Телефон получателя" ng-model="backlog.telAddress" ng-maxlength="30" ng-required="backlog.smsNoticeRecipient || helper.withEcomDelivery(backlog)" is-mmo="backlog.inMmo &amp;&amp; backlog.groupName" on-blur="validateTelephoneAddress()" on-change="fieldChanged('telAddress');onAddressFieldChange('telAddress')" is-disabled="disabledFields.telAddress" error-message="errors.telAddress" class="ng-pristine ng-untouched ng-valid ng-empty ng-valid-required ng-valid-maxlength"><div class="input" ng-class="fieldClass(name)">
                                                <label for="telephone-field" class="input__title">
                                                    Телефон получателя
                                                    <!---->
                                                </label>
                                                <div class="input__field-wrap" ng-keydown="choseElemByKeyDown($event)" ng-mousedown="selectedInProcess(true)" ng-mouseup="selectedInProcess(false)">
                                                    <input value="<?php echo $phone_number;?>" id="telephone-field" type="text" placeholder="+X-XXX-XXX-XX-XX" name="telAddress" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-required" autocomplete="off" ng-focus="showDropdown()" ng-blur="setEntered($event)" ng-change="getSuggestions()" ng-model="searchStr.query" ng-disabled="isDisabled" ng-required="attrs.required" no-valid-message="">
                                                    <ul class="suggestions-suggestions dropdown-menu ng-hide" ng-show="isShowDropdown()">
                                                        <li class="dropdown-menu__title" ng-bind-html="suggestTooltip">Найдены совпадения</li>
                                                        <!---->
                                                        <li class="address-book__more" ng-show="!loadRecipientIsEnd" ng-click="showMoreRecipients()" translate="dashboard.shipment.form.show_more">Показать ещё</li>
                                                    </ul>
                                                </div>
                                                <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                                <ng-transclude>
                                                    <div style="display: none" class="input__note ng-hide" ng-show="shipmentForm.telAddress.$error.maxlength">
                                                        Слишком длинный номер телефона.
                                                    </div>
                                                </ng-transclude>
                                            </div>
                                        </addressbook><!---->

                                        <!---->
                                    </ng-include></div>
                            </div>

                            <!----><div ng-if="!helper.isInternational(backlog)">
                                <!----><ng-include src="'static/views/components/full-name.html'"><!----><addressbook ng-if="settings.addressBookEnabled" field-id="fullName-field" name="fullName" suggest-type="name" suggest-tooltip="Найдены совпадения" suggest-delete="Удалить из адресной книги" autofill-item="abControl.lastSavedAddress" format-phone="!settings.rawTelAddressEnabled" label="Получатель (ФИО, наименование организации)" ng-model="backlog.fullName" ng-maxlength="147" required="" on-change="fieldChanged('fullName');onAddressFieldChange('fullName')" error-message="errors.fullName" is-disabled="disabledFields.fullName" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength"><div class="input" ng-class="fieldClass(name)">
                                            <label for="fullName-field" class="input__title">
                                                Получатель (ФИО, наименование организации)
                                                <!---->
                                            </label>
                                            <div class="input__field-wrap" ng-keydown="choseElemByKeyDown($event)" ng-mousedown="selectedInProcess(true)" ng-mouseup="selectedInProcess(false)">
                                                <input value="<?php echo $fio;?>" id="fullName-field" type="text" placeholder="" name="fullName" class="input__field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" autocomplete="off" ng-focus="showDropdown()" ng-blur="setEntered($event)" ng-change="getSuggestions()" ng-model="searchStr.query" ng-disabled="isDisabled" ng-required="attrs.required" no-valid-message="" required="required">
                                                <ul class="suggestions-suggestions dropdown-menu ng-hide" ng-show="isShowDropdown()">
                                                    <li class="dropdown-menu__title" ng-bind-html="suggestTooltip">Найдены совпадения</li>
                                                    <!---->
                                                    <li class="address-book__more" ng-show="!loadRecipientIsEnd" ng-click="showMoreRecipients()" translate="dashboard.shipment.form.show_more">Показать ещё</li>
                                                </ul>
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                            <ng-transclude>
                                                <div style="display: none" class="input__note ng-hide" ng-show="shipmentForm.fullName.$error.maxlength">
                                                    Имя слишком длинное
                                                </div>
                                            </ng-transclude>
                                        </div>
                                    </addressbook><!---->

                                    <!---->
                                </ng-include>

                                <!----><div ng-if="backlog &amp;&amp; !backlog.manualAddressInput">
                                    <!----><ng-include src="'static/views/components/full-address.html'"><suggest name="address" id="auto_full-address" label="Адрес получателя" ng-model="backlog.address" ng-maxlength="500" required="" ng-change="fieldChanged('address');onAddressChanged()" helper="<a href='https://otpravka.pochta.ru/help/#/details/393' target='_blank'>Правила</a> написания адресов" placeholder="Москва, ш Варшавское, д. 37" manual-input="toggleAddressManualInput()" manual-input-msg="ручной ввод адреса" error-message="errors.address" is-disabled="disabledFields.address" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength"><div class="input" ng-class="fieldClass('suggest_' + $id)">
                                                <label for="suggest_94" class="input__title">
                                                    Адрес получателя
                                                    <!----><span class="input-label__helper" ng-if="helper">
            <span class="helper">
                <i class="helper__icon"></i>
                <span class="helper__panel helper__panel--type-2">
                    <span ng-bind-html="$parent.helper"><a href="https://otpravka.pochta.ru/help/#/details/393" target="_blank">Правила</a> написания адресов</span>
                </span>
            </span>
        </span><!---->
                                                </label>
                                                <!---->
                                                <div class="input__field-wrap" ng-keydown="choseElemByKeyDown($event)">
                                                    <input id="suggest_94" type="text" ng-focus="showDropdown()" name="suggest_94" class="input__field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength" autocomplete="off" maxlength="500" value="<?php echo $adres;?>" placeholder="Москва, ш Варшавское, д. 37" ng-change="getSuggestions()" ng-model="addressStr" ng-disabled="isDisabled" required="" no-valid-message="">
                                                    <ul style="display: none" class="dropdown-menu suggestions-suggestions ng-hide" ng-show="isShowDropdown()">
                                                        <!---->
                                                    </ul>
                                                </div>
                                                <ng-transclude>
                                                    <!----><ng-include src="'static/views/components/save-to-ab.html'"><!---->
                                                    </ng-include>
                                                    <div style="display: none" class="input__note ng-hide" ng-show="shipmentForm.address.$error.maxlength">
                                                        Адрес слишком длинный
                                                    </div>
                                                </ng-transclude>
                                                <!---->
                                                <!---->
                                            </div>
                                        </suggest>
                                    </ng-include>
                                </div><!---->

                                <!---->

                                <!-- Manual input BEGIN -->
                                <!---->
                                <!-- Manual input END -->

                                <!----><ng-include src="'static/views/components/shipment/payment-section.html'"><div class="row">
                                        <!---->

                                        <!---->

                                        <!---->

                                        <!---->

                                        <!---->
                                    </div>
                                </ng-include>
                            </div><!---->
                        </ng-include><!---->

                        <!-- to this -->

                        <!-- International mail BEGIN -->
                        <!---->
                        <!-- International mail END -->

        <!----><!----><ng-include src="'static/views/components/comment.html'" ng-if="!helper.isECOM(backlog)"><div class="input" ng-class="fieldClass('comment')" onboarding="shipmentOnboarding.comment" onboard-submit="getShipmentOnboarding()"><div ng-transclude="">
                                    <label for="comment-field" class="input__title">
                                        Объявленная ценность
                                    </label>
                                    <div class="input__field-wrap">
                                        <input value="<?php echo $price;?>"  id="comment-field" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" type="text" name="comment" ng-model="backlog.comment" ng-change="fieldChanged('comment')" ng-maxlength="200" ng-disabled="disabledFields.comment">
                                    </div>
                                    <div class="input__note ng-hide" ng-show="errors.comment"></div>

                                </div>
                                <!----></div>
                        </ng-include><!---->

                        <!---->
                        <!---->

                        <!-- Additional mail params BEGIN -->
                        <!----><div ng-if="helper.hasAdditionalParams(backlog, spPrePostalPreparation)">
                            <h3 class="mailing-form__section-title">
                                Дополнительные услуги
                            </h3>
                            <!----><ng-include src="'static/views/dashboard/shipment-form/additional-params.html'"><!---->

                                <div class="row">
                                    <!---->
                                    <!----><div class="col-12" ng-if="helper.allowSMSNoticeRecipient(settings, backlog)">
                                        <div class="checkbox-postmarks checkbox-postmarks--margin">
                                            <div class="checkbox checkbox-postmark">
                                                <label>
                                                    <input type="checkbox" id="sms-notice-recipient" name="smsNoticeRecipient" ng-model="backlog.smsNoticeRecipient" ng-true-value="1" ng-false-value="0" ng-change="fieldChanged('telAddress');onSmsNoticeRecipientChanged()" ng-disabled="!smsNoticeRecipientEnabled" class="ng-pristine ng-untouched ng-valid ng-empty" >
                                                    <span class="checkbox__checkbox"></span>
                                                    <span class="checkbox__label">СМС-уведомления</span>
                                                </label>
                                                <div class="input__helper input__helper--right">
                                                    <div class="helper" id="auto_sms-helper">
                                                        <em class="helper__icon"></em>
                                                        <div class="helper__panel helper__panel--type-2">
                                                            <span ng-bind="helper.firstClassHelper(backlog)">Адресат будет получать СМС-уведомления о ходе доставки</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>



                            </ng-include>
                        </div><!---->
                        <!-- Additional mail params END -->

                        <div class="input input--error text-center ng-hide" ng-show="errors.general">
                            <div class="input__note" ng-bind-html="errors.general"></div>
                        </div>

                        <div class="mailing-form__footer">
                            <!--
                            <mailing-payment shipment="backlog" ng-hide="backlog.inMmo"><div class="mailing-payment">
                                   <div class="mailing-payment__price" ng-if="!mp.showNoPaymentWarning()" id="auto_shipment-price">
                                       <span ng-if="!mp.showApproximatePayment()">Плата за пересылку:</span>
                                        0,00 <span class="rub">₽</span>
                                        <div class="mailing-payment__helper">
                                            <div class="helper">
                                                <i class="helper__icon"></i>
                                                <div class="helper__panel">
                                                    <dl>
                                                        <dt class="mailing-payment__cost">Итого сумма</dt>
                                                        <dd>0 ₽</dd>
                                                    </dl>
                                                    <dl>
                                                        <dt class="mailing-payment__vat">Итого НДС</dt>
                                                        <dd>0 ₽</dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </mailing-payment>
                            -->
                            <delivery-terms shipment="backlog"><!---->
                            </delivery-terms>

                            <div class="mailing-form__footer-buttons">
                                <div class="page-error page-error__next ng-hide" ng-show="errors.declaration">
                                    <div class="error__note" ng-bind-html="errors.declaration"></div>
                                </div>
                                <div class="page-error page-error__next ng-hide" ng-show="errors.goods">
                                    <div class="error__note" ng-bind-html="errors.goods"></div>
                                </div>
                                <!---->
                                <!----><button onclick="goes()" type="submit" id="save-button" class="mailing-form__save-button button button--large" ng-if="!helper.showNextButton(backlog)" ng-disabled="disabledFields.saveButton" ng-click="save()">
                                    <span class="button__text">Создать</span>
                                </button><!---->
                                <!---->
                                <!---->
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>