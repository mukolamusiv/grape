<template>
<transition
    appear name="lumencard"
    enter-active-class='animate__animated animate__backInLeft' appear-active-class="animate__animated animate__backInLeft"

>
    <div class="card h-lg-100">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <!--begin::Icon-->
            <div class="m-0">
                <i class="fonticon-sun fs-4x text-warning text-center"></i>
            </div>
            <!--end::Icon-->
            <!--begin::Section-->
            <div class="d-flex flex-column my-7">
                <!--begin::Number-->
                <span class="fw-bold fs-3x text-gray-800 lh-1 ls-n2">15</span>
                <!--end::Number-->
                <!--begin::Follower-->
                <div class="m-0">
                    <span class="fw-bold fs-6 text-gray-400">Промінчиків</span>
                </div>
                <!--end::Follower-->
            </div>
            <!--end::Section-->
            <!--begin::Badge-->
            <span class="badge badge-light-success fs-base">
													<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
													<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
															<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
														</svg>
													</span>
                <!--end::Svg Icon-->+10</span>
            <!--end::Badge-->
        </div>
        <!--end::Body-->
    </div>
</transition>
</template>

<script>
export default {
name: "LumenCard"
}
</script>

<style scoped>

</style>
