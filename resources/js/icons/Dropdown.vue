<template functional>
    <svg xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 0 44 22"
        class="">
        <defs>
            <path id="a"
                d="M0 0h44v22H0z"></path>
            <path id="c"
                d="M2 22L22 2l20 20z"></path>
        </defs>
        <g fill="none"
            fill-rule="evenodd">
            <mask id="b"
                fill="#fff">
                <use xlink:href="#a"></use>
            </mask>
            <g mask="url(#b)">
                <use fill="#FFF"
                    xlink:href="#c"></use>
                <path class="dropdown-svg-path"
                    d="M.793 22.5L22 1.293 43.207 22.5H.793z"></path>
            </g>
        </g>
    </svg>
</template>