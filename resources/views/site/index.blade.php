<x-site-layout>
    <x-slot name="main">
        <section class="main_container b_bottom pos_r">
            <div class="wrapper">
                <div class="main_text b_right">
                    <h1>Koblia Vino</h1>
                    <p>Вино з душею та іменем</p>
                    <div class="btn_container flex items_center gap_20">
                        <a class="cta fill_btn" href="{{ route('site.catalogue') }}">каталог</a>
                        <a class="cta transparent_btn" href="#">співпраця</a>
                    </div>
                </div>
            </div>
            <picture>
                <img src="{{ asset('img/main_bg.jpg') }}" alt="">
            </picture>
        </section>
        <section class="advantages_container b_bottom">
            <div class="wrapper grid adv_col_6">
                <div class="adv_block">
                    <picture>
                        <img src="{{ asset('img/second_1.jpg') }}" alt="">
                    </picture>
                </div>
                <div class="adv_block">
                    <p>натуральне</p>
                </div>
                <div class="adv_block">
                    <picture>
                        <img src="{{ asset('img/second_2.jpg') }}" alt="">
                    </picture>
                </div>
                <div class="adv_block">
                    <p>без цукру</p>
                </div>
                <div class="adv_block">
                    <picture>
                        <img src="{{ asset('img/second_3.jpg') }}" alt="">
                    </picture>
                </div>
                <div class="adv_block b_right">
                    <p>крафтове</p>
                </div>
            </div>
        </section>
        <section class="adout_us_container b_bottom b_top" id="about">
            <div class="wrapper grid col_2">
                <div class="about_img_block grid">
                    <picture>
                        <img src="{{ asset('img/about_1.jpg') }}" alt="">
                    </picture>
                    <picture>
                        <img src="{{ asset('img/about_2.jpg') }}" alt="">
                    </picture>
                    <picture>
                        <img src="{{ asset('img/about_3.jpg') }}" alt="">
                    </picture>
                </div>
                <div class="about_us_text b_left direction_center">
                    <h2>Про нас</h2>
                    <p>У прохолоді старого кам’яного погребу народжується щось більше, ніж вино — народжується історія.</p>
                    <p><span class="span_text">Koblia Vino</span> — крафтове вино з винограду та лохини, створене так, щоб кожен ковток відчувався, як момент, який хочеться запам’ятати.</p>
                    <p>Воно міцне, як земля, де зріли ягоди. Щире, як руки винороба, що вклали в нього душу. Це не просто напій. Це вибір тих, хто знає, що таке справжній смак і справжні емоції.</p>
                </div>
            </div>
        </section>
        <section class="history_container b_bottom">
            <div class="wrapper b_left b_right tac">
                <h2>історія, що нас єднає</h2>
                <p>Бренд Koblia Vino народився не в офісі та не на фабриці. Його витоки — у теплих родинних вечорах, у дозрілому винограді під літнім сонцем, у щирому бажанні створити продукт, що має душу.</p>
                <p>Десять років тому засновник бренду робив вино лише для найближчих — чесне, натуральне, без жодних добавок.</p>
                <p class="span_text">Без сірки. Без цукру.</p>
                <p>Тільки виноград і природні процеси, що зберігають його справжній характер.</p>
                <p>Саме тоді зародилася <span class="span_text">філософія Koblia Vino</span> — філософія чистоти, простоти та поваги до природи, яка не змінилась і сьогодні.</p>
                <p>Назва Koblia — це частина родинного прізвища. Це підпис, відповідальність і чесність, вкладені у кожну пляшку. Кожен ковток — результат ручної праці, досвіду й любові, які передаються від року до року.</p>
                <p>Вино залишається крафтовим та унікальним, створеним так само, як і в перший день — з увагою, акуратністю та повагою до традицій.</p>
            </div>
        </section>
        <section class="video_container b_bottom">
            <div class="wrapper">
                <video loading="lazy" preload="none" autoplay loop muted playsinline>
                    <source src="{{asset('/video/video.mp4')}}">
                </video>
            </div>
        </section>
        <section class="information_koblia_container">
            <div class="b_bottom">
                <div class="wrapper">
                    <div class="grid col_2 b_left b_right">
                        <div class="direction_center b_right philosophi_text">
                            <h2>філософія koblia vino</h2>
                            <p><span class="span_text">Koblia Vino</span> — це історія про традиції. Про чесність у кожній краплі. Про людей, які створюють не просто продукт, а частину себе.</p>
                            <p>Ми віримо, що чисте вино може народитися тільки з чистих намірів. Тому ми не додаємо нічого зайвого. Не йдемо шляхом масового виробництва.</p>
                            <p>Ми обираємо справжність — у процесах, у смаку, у відносинах з людьми.</p>
                            <p class="span_text">10 років. Один шлях.</p>
                            <p>Одна філософія — чисте вино з чистим серцем.</p>
                        </div>
                        <div>
                            <picture>
                                <img src="{{ asset('img/philosophi.jpg') }}" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b_bottom">
                <div class="wrapper">
                    <div class="grid col_2 b_left b_right">
                        <div>
                            <picture>
                                <img src="{{ asset('img/degustation.jpg') }}" alt="">
                            </picture>
                        </div>
                        <div class="direction_center b_left degustation_text">
                            <h2>Як проходить дегустація</h2>
                            <p><span class="span_text">Дегустація організовується у зручному для вас форматі</span> — у вашому закладі або за попередньою домовленістю.</p>
                            <p>Ми презентуємо лінійку наших вин, розповідаємо про особливості виробництва, стилістику кожного вина та рекомендації щодо гастропар.</p>
                            <p>Формат дегустації дозволяє підібрати позиції, які найкраще доповнять вашу винну карту та концепцію закладу.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b_bottom list_info">
                <div class="wrapper">
                    <div class="grid col_2 b_left b_right">
                        <div class="direction_center b_right colab_text">
                            <h2>Співпраця для ресторанів</h2>
                            <p>Ми відкриті до довгострокової співпраці з ресторанами, винними барами, готелями та кейтеринговими компаніями, які цінують автентичність продукту, локальне походження та стабільну якість.</p>
                            <p>Співпраця може бути як разовою, так і на постійній основі з регулярними поставками.</p>
                            <p class="span_text">Ми пропонуємо гнучкі умови співпраці для сегменту HoReCa:</p>
                            <ul>
                                <li>Прямі поставки;</li>
                                <li>Стабільна якість;</li>
                                <li>Ексклюзивні пропозиції.</li>
                            </ul>
                        </div>
                        <div>
                            <picture>
                                <img src="{{ asset('img/colaboration.jpg') }}" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="colab_container b_bottom">
            <div class="wrapper tac direction_center gap_50 colab_block items_center b_left b_right">
                <h2>Ми завжди відкриті до співпраці</h2>
                <p>Якщо ви шукаєте локальне крафтове вино для свого закладу — залиште контакти, і ми зв’яжемося з вами, щоб організувати дегустацію та обговорити співпрацю.</p>
                <a href="#" class="cta fill_btn">залишити заявку</a>
            </div>
        </section>
        <section class="events_container direction_center">
            <div class="wrapper tac">
                <h2>події</h2>
                <div class="b_top b_left b_right b_bottom">
                    <picture>
                        <img src="{{ asset('img/personal.jpg') }}" alt="">
                    </picture>
                    <p>У дегустаційному конкурсі Wine&Spirits Ukraine 2025, отримали золоту медаль за вино «Muscat»</p>
                </div>
            </div>
        </section>
        @include('components.top_product')
        <section class="order b_bottom" id="cooperation">
            <div class="wrapper">
                <h2>співраця</h2>
                <p class="tac">Як виробники крафтового вина, ми створюємо продукцію з характером, історією та незмінною увагою до деталей. Працюємо з HoReCa, гуртовими покупцями, приватними сомельє та винними просторами.</p>
                <p class="tac">Залишіть свої контакти і ми зателефонуємо вам найближчим часом.</p>
                <form class="form_order" action="{{ route('site.orderStore') }}" method="POST">
                    @csrf
                    <div class="grid col_2 gap_20">
                        <label>
                            Ваше імʼя<span class="span_text">*</span>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </label>
                        <label>
                            Ваш телефон<span class="span_text">*</span>
                            <input class="phoneInput inputMask" type="tel" name='userPhone' required maxlength='13' >
                        </label>
                    </div>
                    <label>
                        Коментар
                        <textarea name="comment"></textarea>
                    </label>
                    <div class="flex justify_center">
                        <button type="submit" class="cta fill_btn">відправити</button>
                    </div>
                </form>
            </div>
        </section>
        @include('components.reviews')
        @include('components.contacts')
    </x-slot>
</x-site-layout>
    