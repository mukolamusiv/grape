<template>
    <transition appear name="peopleprofile"
                enter-active-class='animate__animated animate__backInDown' appear-active-class="animate__animated animate__backInDown"
    >
    <div class="card border-0 h-md-100" style="background: linear-gradient(112.14deg, #b8d935 0%, #3A7BD5 100%)">
        <!--begin::Body-->
        <div class="card-body">

            <!--begin::Row-->
            <div class="row align-items-center h-100">
                <!--begin::Col-->
                <div class="col-7 ps-xl-13">
                    <!--begin::Title-->
                    <div class="text-white mb-6 pt-6">
                        <span class="fs-4 fw-bold me-2 d-block lh-1 pb-2 opacity-75">Активний курс</span>
                        <span class="fs-2qx fw-bolder">Приготування до Хрещення</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <span class="fw-bold text-white fs-6 mb-8 d-block opacity-75">Опис курсу про хрещення</span>
                    <!--end::Text-->
                    <!--begin::Items-->
                    <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center me-5 me-xl-13">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px symbol-circle me-3">
                                <i class="fonticon-sun fs-4x text-warning text-center"></i>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="text-white">
                                <span class="fw-bold d-block fs-8 opacity-75">Промінчики</span>
                                <span class="fw-bolder fs-7">+120</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px symbol-circle me-3">
                                <i class="las la-tint text-primary fs-4x"></i>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="text-white">
                                <span class="fw-bold opacity-75 d-block fs-8">Каплі</span>
                                <span class="fw-bolder fs-7">+50</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->

                    <!--begin::Action-->
                    <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                        <a href="#" class="btn btn-success flex-shrink-0 me-2">Продовжити навчання</a>
                        <a href="#" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)" >Переглянути</a>
                    </div>
                    <!--end::Action-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-5 pt-10">
                    <!--begin::Illustration-->
                    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url('assets/media/svg/illustrations/easy/5.svg');"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Body-->
    </div>
    </transition>
</template>

<script>
export default {
    name: "ActiveCard"
}
</script>

<style scoped>

</style>
