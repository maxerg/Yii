<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отправка</title>
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
                                <div class="col-24"><!----><ng-include src="'static/views/components/post-office.html'"><dropdown ng-model="backlog.postOfficeCode" name="postOfficeCode" list="postalOperators" text-property="text" model-property="code" label="Отделение для отправки" force-error-show="!backlog.empty || shipmentForm.$submitted" error-message="errors.postOfficeCode" required="" ng-change="fieldChanged('postOfficeCode');onPostOfficeCodeChanged()" is-disabled="disabledFields.postCode" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><div class="input input--select" ng-class="fieldClass()" id="dropdown-86">

                                                <label class="input__title" ng-show="label">
                                                    Отделение для отправки
                                                    <!---->
                                                </label>

                                                <div class="input__field-wrap" ng-class="{ 'clicked': listVisible }">
                                                    <input type="text" name="postOfficeCode" class="input__field" value="" ng-focus="show($event)" ng-blur="hide($event)" ng-required="fieldRequired" no-valid-message="" required="required">

                                                    <div class="input__value" ng-click="show()" ng-class="displayClass" ng-blur="hide($event)" tabindex="-1"></div>
                                                    <em class="input__icon input__icon--caret-down" ng-click="show()"></em>

                                                    <div class="input__suggest" id="auto_input-suggest">
                                                        <div class="input__suggest-search">
                                                            <!---->
                                                            <!---->
                                                        </div>
                                                        <div ng-class="getListClass()">
                                                            <!---->
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="input__note ng-hide" ng-show="note" ng-bind-html="note"></div>
                                                <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                            </div>
                                        </dropdown>
                                        <!---->
                                    </ng-include></div>
                            </div>
                            <div class="row">
                                <div class="col-12"><!----><ng-include src="'static/views/components/mail-type.html'"><dropdown ng-model="backlog.mailType" name="mailType" list="mailTypes" text-property="text" model-property="code" listclass="" label="Тип отправления" ng-change="fieldChanged('mailType');onMailTypeChanged()" force-error-show="!backlog.empty || shipmentForm.$submitted" error-message="errors.mailType" required="" dis-holder="Нет подключенных услуг" is-disabled="disabledFields.mailType" class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><div class="input input--select" ng-class="fieldClass()" id="dropdown-87">

                                                <label class="input__title" ng-show="label">
                                                    Тип отправления
                                                    <!---->
                                                </label>

                                                <div class="input__field-wrap" ng-class="{ 'clicked': listVisible }">
                                                    <input type="text" name="mailType" class="input__field" value="" ng-focus="show($event)" ng-blur="hide($event)" ng-required="fieldRequired" no-valid-message="" required="required">

                                                    <div class="input__value" ng-click="show()" ng-class="displayClass" ng-blur="hide($event)" tabindex="-1"></div>
                                                    <em class="input__icon input__icon--caret-down" ng-click="show()"></em>

                                                    <div class="input__suggest" id="auto_input-suggest">
                                                        <div class="input__suggest-search">
                                                            <!---->
                                                            <!---->
                                                        </div>
                                                        <div ng-class="getListClass()">
                                                            <!---->
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="input__note ng-hide" ng-show="note" ng-bind-html="note"></div>
                                                <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                            </div>
                                        </dropdown>
                                    </ng-include></div>
                                <div class="col-12"><!----><ng-include src="'static/views/components/mass.html'"><div class="input" ng-class="fieldClass('mass')">
                                            <label for="mass-field" class="input__title mailing-form__nowrap-input">
                                                Вес в граммах c упаковкой
                                            </label>
                                            <div class="input__field-wrap">
                                                <input id="mass-field" type="number" name="mass" ng-model="backlog.mass" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-min ng-valid-max ng-valid-required ng-valid-pattern" ng-required="backlog.massRequired" min="" max="" placeholder="" ng-pattern="/^[0-9]+$/" delay-call="onMassChanged()" delay="500" ng-change="fieldChanged('mass')" ng-disabled="disabledFields.mass" onwheel="this.blur()" no-valid-message="">
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

                            <div class="row ng-hide" ng-show="backlog.oversized">
                                <!----><ng-include src="'static/views/components/oversized.html'"><div class="col-8">
                                        <div class="input" ng-class="fieldClass('length')">
                                            <label for="length-field" class="input__title">
                                                Длина, см
                                            </label>
                                            <div class="input__field-wrap">
                                                <input id="length-field" type="text" name="length" ng-model="backlog.length" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-pattern ng-valid-required ng-valid-maxlength" min="1" max="999" ng-required="backlog.oversized" delay-call="calcShipmentCost()" delay="500" ng-change="fieldChanged('length')" pattern="^[1-9][0-9]{0,2}$" maxlength="3" no-valid-message="">
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errors.length"></div>
                                            <div class="input__note ng-hide" ng-show="shipmentForm.length.$error.pattern">
                                                Пожалуйста, укажите целое число, например, 25
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="input" ng-class="fieldClass('width')">
                                            <label for="width-field" class="input__title">
                                                Ширина, см
                                            </label>
                                            <div class="input__field-wrap">
                                                <input id="width-field" type="text" name="width" ng-model="backlog.width" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-pattern ng-valid-required ng-valid-maxlength" min="1" max="999" ng-required="backlog.oversized" delay-call="calcShipmentCost()" delay="500" ng-change="fieldChanged('width')" pattern="^[1-9][0-9]{0,2}$" maxlength="3" no-valid-message="">
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errors.width"></div>
                                            <div class="input__note ng-hide" ng-show="shipmentForm.width.$error.pattern">
                                                Пожалуйста, укажите целое число, например, 25
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="input" ng-class="fieldClass('height')">
                                            <label for="height-field" class="input__title">
                                                Высота, см
                                            </label>
                                            <div class="input__field-wrap">
                                                <input id="height-field" type="text" name="height" ng-model="backlog.height" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-pattern ng-valid-required ng-valid-maxlength" min="1" max="999" ng-required="backlog.oversized" delay-call="calcShipmentCost()" delay="500" ng-change="fieldChanged('height')" pattern="^[1-9][0-9]{0,2}$" maxlength="3" no-valid-message="">
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errors.height"></div>
                                            <div class="input__note ng-hide" ng-show="shipmentForm.height.$error.pattern">
                                                Пожалуйста, укажите целое число, например, 25
                                            </div>
                                        </div>
                                    </div></ng-include>
                            </div>
                            <!---->
                            <!---->
                            <div class="row">
                                <div class="col-12"><!----><ng-include src="'static/views/components/order-num.html'"><div class="input" ng-class="fieldClass('orderNum')">
                                            <label for="orderNum-field" class="input__title">
                                                <span ng-bind-html="helper.orderNumText(backlog)">Внутренний номер отправления</span>
                                                <div class="input-label__helper">
                                                    <div class="helper" id="auto_order-num-helper">
                                                        <em class="helper__icon"></em>
                                                        <div class="helper__panel helper__panel--type-2">
                                                            <span>Подробнее в <a target="_blank" href="https://otpravka.pochta.ru/help/#/details/103">статье</a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                            <div class="input__field-wrap">
                                                <input id="orderNum-field" type="text" name="orderNum" ng-model="backlog.orderNum" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-required ng-valid-pattern ng-valid-maxlength" ng-maxlength="200" ng-change="fieldChanged('orderNum')" ng-required="helper.isOrderNumRequired(backlog)" ng-pattern="" no-valid-message="">
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errors.orderNum"></div>
                                            <div class="input__note ng-hide" ng-show="shipmentForm.orderNum.$error.maxlength">
                                                Максимальная длина поля - 200 симв.
                                            </div>
                                            <div class="input__note ng-hide" ng-show="shipmentForm.orderNum.$error.pattern">
                                                Номер должен содержать только цифры, латинские буквы и спецсимволы
                                            </div>
                                        </div>
                                    </ng-include></div>
                                <div class="col-12"><!----><ng-include src="'static/views/components/tel-address.html'"><!----><addressbook ng-if="settings.addressBookEnabled" field-id="telephone-field" name="telAddress" placeholder="+X-XXX-XXX-XX-XX" suggest-type="phone" suggest-tooltip="Найдены совпадения" suggest-delete="Удалить из адресной книги" autofill-item="abControl.lastSavedAddress" format-phone="!settings.rawTelAddressEnabled" label="Телефон получателя" ng-model="backlog.telAddress" ng-maxlength="30" ng-required="backlog.smsNoticeRecipient || helper.withEcomDelivery(backlog)" is-mmo="backlog.inMmo &amp;&amp; backlog.groupName" on-blur="validateTelephoneAddress()" on-change="fieldChanged('telAddress');onAddressFieldChange('telAddress')" is-disabled="disabledFields.telAddress" error-message="errors.telAddress" class="ng-pristine ng-untouched ng-valid ng-empty ng-valid-required ng-valid-maxlength"><div class="input" ng-class="fieldClass(name)">
                                                <label for="telephone-field" class="input__title">
                                                    Телефон получателя
                                                    <!---->
                                                </label>
                                                <div class="input__field-wrap" ng-keydown="choseElemByKeyDown($event)" ng-mousedown="selectedInProcess(true)" ng-mouseup="selectedInProcess(false)">
                                                    <input id="telephone-field" type="text" placeholder="+X-XXX-XXX-XX-XX" name="telAddress" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-required" autocomplete="off" ng-focus="showDropdown()" ng-blur="setEntered($event)" ng-change="getSuggestions()" ng-model="searchStr.query" ng-disabled="isDisabled" ng-required="attrs.required" no-valid-message="">
                                                    <ul class="suggestions-suggestions dropdown-menu ng-hide" ng-show="isShowDropdown()">
                                                        <li class="dropdown-menu__title" ng-bind-html="suggestTooltip">Найдены совпадения</li>
                                                        <!---->
                                                        <li class="address-book__more" ng-show="!loadRecipientIsEnd" ng-click="showMoreRecipients()" translate="dashboard.shipment.form.show_more">Показать ещё</li>
                                                    </ul>
                                                </div>
                                                <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                                <ng-transclude>
                                                    <div class="input__note ng-hide" ng-show="shipmentForm.telAddress.$error.maxlength">
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
                                                <input id="fullName-field" type="text" placeholder="" name="fullName" class="input__field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" autocomplete="off" ng-focus="showDropdown()" ng-blur="setEntered($event)" ng-change="getSuggestions()" ng-model="searchStr.query" ng-disabled="isDisabled" ng-required="attrs.required" no-valid-message="" required="required">
                                                <ul class="suggestions-suggestions dropdown-menu ng-hide" ng-show="isShowDropdown()">
                                                    <li class="dropdown-menu__title" ng-bind-html="suggestTooltip">Найдены совпадения</li>
                                                    <!---->
                                                    <li class="address-book__more" ng-show="!loadRecipientIsEnd" ng-click="showMoreRecipients()" translate="dashboard.shipment.form.show_more">Показать ещё</li>
                                                </ul>
                                            </div>
                                            <div class="input__note ng-hide" ng-show="errorMessage" ng-bind-html="errorMessage"></div>
                                            <ng-transclude>
                                                <div class="input__note ng-hide" ng-show="shipmentForm.fullName.$error.maxlength">
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
                                                <!----><button type="button" class="text-button pull-right" ng-if="!isDisabled" ng-click="manualInput()">
                                                    <b class="text-button__label">ручной ввод адреса</b>
                                                </button><!---->
                                                <div class="input__field-wrap" ng-keydown="choseElemByKeyDown($event)">
                                                    <input id="suggest_94" type="text" ng-focus="showDropdown()" name="suggest_94" class="input__field ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength" autocomplete="off" maxlength="500" placeholder="Москва, ш Варшавское, д. 37" ng-change="getSuggestions()" ng-model="addressStr" ng-disabled="isDisabled" required="" no-valid-message="">
                                                    <ul class="dropdown-menu suggestions-suggestions ng-hide" ng-show="isShowDropdown()">
                                                        <!---->
                                                    </ul>
                                                </div>
                                                <ng-transclude>
                                                    <!----><ng-include src="'static/views/components/save-to-ab.html'"><!---->
                                                    </ng-include>
                                                    <div class="input__note ng-hide" ng-show="shipmentForm.address.$error.maxlength">
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
                                        Комментарий к отправлению
                                    </label>
                                    <div class="input__field-wrap">
                                        <input id="comment-field" class="input__field ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" type="text" name="comment" ng-model="backlog.comment" ng-change="fieldChanged('comment')" ng-maxlength="200" ng-disabled="disabledFields.comment">
                                    </div>
                                    <div class="input__note ng-hide" ng-show="errors.comment"></div>
                                    <div class="input__note ng-hide" ng-show="shipmentForm.comment.$error.maxlength">
                                        Максимальная длина поля - 200 символов
                                    </div>
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
                                                    <input type="checkbox" id="sms-notice-recipient" name="smsNoticeRecipient" ng-model="backlog.smsNoticeRecipient" ng-true-value="1" ng-false-value="0" ng-change="fieldChanged('telAddress');onSmsNoticeRecipientChanged()" ng-disabled="!smsNoticeRecipientEnabled" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled">
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

                                <div class="row">
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                                <div class="row">
                                    <!---->

                                    <!---->

                                    <!---->

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
                            <mailing-payment shipment="backlog" ng-hide="backlog.inMmo"><div class="mailing-payment">
                                    <!---->
                                    <!----><div class="mailing-payment__price" ng-if="!mp.showNoPaymentWarning()" id="auto_shipment-price">
                                        <!---->
                                        <!----><span ng-if="!mp.showApproximatePayment()">Плата за пересылку:</span><!---->
                                        0,00 <span class="rub">₽</span>
                                        <div class="mailing-payment__helper">
                                            <div class="helper">
                                                <i class="helper__icon"></i>
                                                <div class="helper__panel">
                                                    <!---->

                                                    <!---->

                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
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
                                    </div><!---->
                                </div>
                            </mailing-payment>
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
                                <!----><button type="submit" id="save-button" class="mailing-form__save-button button button--large" ng-if="!helper.showNextButton(backlog)" ng-disabled="disabledFields.saveButton" ng-click="save()">
                                    <span class="button__text">Сохранить отправление</span>
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