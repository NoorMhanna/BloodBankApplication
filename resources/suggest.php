<section class="SuggestSection aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
    <div class="introSuggest text-center">
        <h4>Suggest Tour</h4>
        <p> Suggest Tour<span> To Be Available</span> As Soon !</p>

    </div>

    <div class="SuggestDescriotion d-flex justify-content-center">
        <img src="http://localhost:8000/storage/BackgroundSuggest.gif" alt="suggest">



        <div class="fillSuggest text-center">
            <h4 class="mt-5 suggestTour">Suggest Your Tour </h4>
            <div class="informationSuggest">

                <form action="http://localhost:8000/suggest/store" method="POST">
                    <input type="hidden" name="_token" value="qQVjCu095idiW5UP46rLB1BREiR6kN1QkOBC1IVP">
                    <div class="d-flex justify-content-center mt-4 ">
                        <i class="fa-solid fa-location-dot locationIcon mt-2"></i>
                        <p class="dateSuggestP me-2"> Select City</p>

                        <select class="location" required="" name="city" id="Box">
                                                        <option></option>
<option value="Jerusalem">القدس</option>
<option value="Bethlehem"> بيت لحم</option>
<option value="Jenin">جِنين</option>
<option value="Tulkarm">طُولكَرْم</option>
<option value="Qalqilya">قَلْقِيلْيَة</option>
<option value="Salfit">سلفيت</option>
<option value="Nablus">نابْلُس</option>
<option value="Tubas">طُوبَاس</option>
<option value="Jericho">أريحا</option>
<option value="Ramallah">رام الله</option>
<option value="Hebron">الخَليل</option>
<option value="Gaza">غزّة</option>
<option value="Khan Yunis">خانيونس</option>
<option value="Deir al Balah"> دِير البَلح</option>
<option value="Rafah">رَفَح</option>
                        </select><br><br>


                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <i class=" fa-solid fa-location-dot locationIcon mt-2"></i>
                        <p class="locationP me-2">Select Location </p>
                        <select class="dateForSuggest" required="" name="destination" id="Box">
                                                        <optgroup label="Jerusalem">
    <option value="Jerusalem">القُدْس </option>
    <option value="Silwan">سلوان</option>
    <option value="Jabel Mukaber">جَبَلْ المُكَبِّر</option>
    <option value="Bidu">بِدُّو</option>
    <option value="Bayt Surik">بِيت سُورِيك</option>
    <option value="Bayt Iksa">بِيت إكْسَا</option>
    <option value=" Beit Hanina">بِيت حَنِينا</option>
    <option value="Nabi Samuil">النَبِي صَمُوئيل</option>
    <option value=" Al Jib>Ath Thuri">الجِيْب</option>
    <option value="Bayt Ijza">بيت إجْزَا</option>
    <option value="Al-Qubeiba">القُبَيْبَة</option>
    <option value="Bayt Duqu">بِيت دُقُّو</option>
    <option value="Beit 'Anan">بيت عَنَان</option>
    <option value="Qatanna">َقطَنَه</option>
    <option value="Kharayib Umm Al Lahim">خَرائِب أمُّ اللَحْمْ</option>
    <option value="Bir Nabala">بِير نَبَالا</option>
    <option value="Kalandia">قَلَنْدِيَا</option>
    <option value="al-Judeira">الجُدَيْرَة</option>
    <option value="Rafat">رَافات</option>
    <option value="Kafr 'Aqab">كَفْر عَقَب</option>
    <option value="Qalandiya refugee camp">مُخَيَّمْ قَلَنْدِيَا</option>
    <option value="Dahiat al'Barid">الرَام وضَاحِيَة البَريد</option>
    <option value="Mukhamas">مِخْمَاس</option>
    <option value="Jaba’">جَبَعْ</option>
    <option value="Hizma">حِزْما</option>
    <option value="Shuafat">شُعْفَاط</option>
    <option value="Al ‘Isawiya">العِيسَوِيَّة</option>
    <option value="Al Za'ayyem">الزْعَيِّمْ</option>
    <option value="Al 'Eizariya">العِيْزَرِيَّة</option>
    <option value="Abu Dis">ابو دِيس</option>
    <option value="Arab al Jahalin">عَرَب الجَهَالين</option>
    <option value="Sawahera al-Sharqiya">السَواحِرَة الشَرْقِيَّة</option>
    <option value="ash-Sheikh Sa'd">الشَيْخ سَعْد</option>
    <option value="alSawahira alGharbiyya">السَواحِرَة الغَرْبِيَّة</option>
    <option value="Sur Baher">صُورْ بَاهِر</option>
    <option value="Umm Tuba">أمُّ طُوبا</option>
    <option value="Beit Safafa">ِبيت صَفَافا</option>
    <option value="Sharfat">شَرَفَات</option>
    <option value="Dheisheh">مُخَيَّمْ الدُهَيْش</option>
</optgroup>









<optgroup label="Rafah">
    <option value="Rafah"> رَفَح</option>
    <option value="Al Nasr">النصر (البَيُّوك)</option>
    <option value="Shokat as Sufi">شُوكَة الصُوفِي</option>
    <option value="Rafah Camp">مُخَيَّم رَفَح</option>
    <option> </option>

</optgroup>
                        </select><br><br>

                    </div>

                    <p class="mt-3 noteSuggest">Your proposed tour will appear to everyone registered on the YallaRehlla
                    </p>

                    <button class="suggestButton">Suggest Now </button>

                    <input type="hidden" value="30" name="user_id">
                </form>
                <br>

                <button class="suggestButton viewSuggetClient" onclick="suggestListPop()">View suggested clients'
                    tours </button>

                <div id="suggestListPop" class="suggestListPop">
                    <div id="suggestList" class="suggestList">

                                                    <div id="suggestList-content" class="suggestList-content">
                                <span class="close" onclick="closeSuggestListPop()">×</span>
                                <h3 class="container text-center">Suggested
                                    tours </h3>
                                <p class="introfav container text-center">support
                                    Tour to be available </p>

                                <div class="itemsSuggestList ">


                                                                            <div class="itemSuggestList d-flex justify-content-start">
                                            <img src="http://localhost:8000/storage/user_img/avatar.png" alt="">

                                                                                            <a href="http://localhost:8000/curdTourWithPopCreateSuggest/Nabi Samuil/25" class="suggestApproved "> <i class="fa-solid fa-clipboard-check"></i></a>

                                            <div class="infoSuggestTour">
                                                <p class="mt-4 ms-1  ">Suggested by
                                                    : noor </p>
                                                <!-- <br> -->
                                                <p class="cityLocationSuggest ">City
                                                    : &nbsp;&nbsp; Location :
                                                    Nabi Samuil</p>

                                                <form method="post" action="http://localhost:8000/suggest/addLikeToSuggest">
                                                    <input type="hidden" name="_token" value="qQVjCu095idiW5UP46rLB1BREiR6kN1QkOBC1IVP">                                                    <button class="suggestLike">
                                                        <i class="fa-solid fa-thumbs-up"></i></button>

                                                    <span> (2) </span>
                                                    <input type="hidden" name="suggest_id" value="8">
                                                    <input type="hidden" name="user_id" value="30">

                                                </form>


                                            </div>
                                            <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                            <!-- <p>Batir Tour </p> -->
                                        </div>
                                                                            <div class="itemSuggestList d-flex justify-content-start">
                                            <img src="http://localhost:8000/storage/user_img/avatar.png" alt="">

                                                                                            <a href="http://localhost:8000/curdTourWithPopCreateSuggest/Bayt Duqu/29" class="suggestApproved "> <i class="fa-solid fa-clipboard-check"></i></a>

                                            <div class="infoSuggestTour">
                                                <p class="mt-4 ms-1  ">Suggested by
                                                    : ahmad </p>
                                                <!-- <br> -->
                                                <p class="cityLocationSuggest ">City
                                                    : &nbsp;&nbsp; Location :
                                                    Bayt Duqu</p>

                                                <form method="post" action="http://localhost:8000/suggest/addLikeToSuggest">
                                                    <input type="hidden" name="_token" value="qQVjCu095idiW5UP46rLB1BREiR6kN1QkOBC1IVP">                                                    <button class="suggestLike">
                                                        <i class="fa-solid fa-thumbs-up"></i></button>

                                                    <span> (1) </span>
                                                    <input type="hidden" name="suggest_id" value="10">
                                                    <input type="hidden" name="user_id" value="30">

                                                </form>


                                            </div>
                                            <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                            <!-- <p>Batir Tour </p> -->
                                        </div>
                                                                            <div class="itemSuggestList d-flex justify-content-start">
                                            <img src="http://localhost:8000/storage/user_img/avatar.png" alt="">

                                                                                            <a href="http://localhost:8000/curdTourWithPopCreateSuggest/Al Jib>Ath Thuri/29" class="suggestApproved "> <i class="fa-solid fa-clipboard-check"></i></a>

                                            <div class="infoSuggestTour">
                                                <p class="mt-4 ms-1  ">Suggested by
                                                    : ahmad </p>
                                                <!-- <br> -->
                                                <p class="cityLocationSuggest ">City
                                                    : &nbsp;&nbsp; Location :
                                                    Al Jib&gt;Ath Thuri</p>

                                                <form method="post" action="http://localhost:8000/suggest/addLikeToSuggest">
                                                    <input type="hidden" name="_token" value="qQVjCu095idiW5UP46rLB1BREiR6kN1QkOBC1IVP">                                                    <button class="suggestLike">
                                                        <i class="fa-solid fa-thumbs-up"></i></button>

                                                    <span> (0) </span>
                                                    <input type="hidden" name="suggest_id" value="11">
                                                    <input type="hidden" name="user_id" value="30">

                                                </form>


                                            </div>
                                            <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                            <!-- <p>Batir Tour </p> -->
                                        </div>
                                                                            <div class="itemSuggestList d-flex justify-content-start">
                                            <img src="http://localhost:8000/storage/user_img/avatar.png" alt="">

                                                                                            <a href="http://localhost:8000/curdTourWithPopCreateSuggest/Rafah/29" class="suggestApproved "> <i class="fa-solid fa-clipboard-check"></i></a>

                                            <div class="infoSuggestTour">
                                                <p class="mt-4 ms-1  ">Suggested by
                                                    : ahmad </p>
                                                <!-- <br> -->
                                                <p class="cityLocationSuggest ">City
                                                    : &nbsp;&nbsp; Location :
                                                    Rafah</p>

                                                <form method="post" action="http://localhost:8000/suggest/addLikeToSuggest">
                                                    <input type="hidden" name="_token" value="qQVjCu095idiW5UP46rLB1BREiR6kN1QkOBC1IVP">                                                    <button class="suggestLike">
                                                        <i class="fa-solid fa-thumbs-up"></i></button>

                                                    <span> (0) </span>
                                                    <input type="hidden" name="suggest_id" value="12">
                                                    <input type="hidden" name="user_id" value="30">

                                                </form>


                                            </div>
                                            <!-- <button class="suggestLike"> <i class="fa-solid fa-thumbs-up"></i></button><span >15 clients </span> -->

                                            <!-- <p>Batir Tour </p> -->
                                        </div>

                                </div>
                            </div>



                    </div>
                </div>

            </div>
        </div>
    </div>


</section>
