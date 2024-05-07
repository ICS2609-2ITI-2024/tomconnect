<?php

namespace Tomconnect\Components;

class OrgRegistrationButton
{
    public static function render($org_name)
    {
?>
    <a href="" class="org-reg-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
            <g clip-path="url(#clip0_328_253)">
                <path d="M15.3479 15.3465C16.7086 13.9859 18.5402 13.2003 20.4638 13.1523C22.3874 13.1043 24.256 13.7975 25.6829 15.0885L25.9544 15.3465L30.1964 19.59C31.5779 20.974 32.3643 22.8429 32.3878 24.7983C32.4114 26.7537 31.6702 28.6409 30.3224 30.0578C28.9746 31.4747 27.1267 32.3091 25.1725 32.3832C23.2184 32.4573 21.3126 31.7652 19.8614 30.4545L19.5914 30.1965L16.4084 27.0135C16.1393 26.7436 15.9831 26.3813 15.9715 26.0004C15.9599 25.6195 16.0937 25.2484 16.3457 24.9626C16.5978 24.6767 16.9492 24.4975 17.3286 24.4614C17.708 24.4253 18.0869 24.5349 18.3884 24.768L18.5294 24.8925L21.7124 28.0755C22.5375 28.9054 23.6534 29.3812 24.8235 29.4021C25.9936 29.4229 27.1258 28.987 27.9799 28.187C28.834 27.3869 29.3429 26.2856 29.3985 25.1166C29.4541 23.9477 29.0521 22.803 28.2779 21.9255L28.0754 21.711L23.8334 17.469C23.4155 17.051 22.9194 16.7195 22.3734 16.4933C21.8273 16.2671 21.2421 16.1507 20.6511 16.1507C20.0601 16.1507 19.4749 16.2671 18.9289 16.4933C18.3828 16.7195 17.8867 17.051 17.4689 17.469C17.1874 17.7503 16.8057 17.9082 16.4078 17.908C16.0099 17.9079 15.6284 17.7497 15.3471 17.4682C15.0658 17.1868 14.9079 16.8051 14.9081 16.4072C14.9082 16.0093 15.0664 15.6278 15.3479 15.3465ZM5.80186 5.80049C7.16255 4.43989 8.99415 3.65433 10.9178 3.60631C12.8414 3.55829 14.71 4.25148 16.1369 5.54249L16.4084 5.80049L19.5899 8.98499C19.8589 9.25493 20.0151 9.61714 20.0267 9.99806C20.0383 10.379 19.9045 10.7501 19.6525 11.0359C19.4004 11.3218 19.049 11.5009 18.6696 11.5371C18.2903 11.5732 17.9113 11.4636 17.6099 11.2305L17.4689 11.106L14.2874 7.92449C13.4608 7.10333 12.348 6.63475 11.183 6.61735C10.018 6.59995 8.89171 7.03507 8.041 7.83117C7.19029 8.62727 6.68152 9.7223 6.62172 10.8859C6.56192 12.0495 6.95575 13.1909 7.72036 14.07L7.92286 14.286L12.1664 18.5295C13.0102 19.3731 14.1546 19.847 15.3479 19.847C16.5411 19.847 17.6855 19.3731 18.5294 18.5295C18.6686 18.3901 18.834 18.2796 19.016 18.2041C19.198 18.1286 19.3931 18.0898 19.5901 18.0897C19.7871 18.0896 19.9822 18.1284 20.1643 18.2037C20.3463 18.279 20.5117 18.3895 20.6511 18.5287C20.7905 18.668 20.901 18.8334 20.9765 19.0154C21.052 19.1974 21.0908 19.3924 21.0909 19.5895C21.091 19.7865 21.0522 19.9816 20.9769 20.1636C20.9016 20.3457 20.7911 20.5111 20.6519 20.6505C19.2912 22.0111 17.4596 22.7966 15.5359 22.8447C13.6123 22.8927 11.7437 22.1995 10.3169 20.9085L10.0439 20.6505L5.80186 16.407C4.39582 15.0005 3.60596 13.0932 3.60596 11.1045C3.60596 9.11576 4.39582 7.20695 5.80186 5.80049Z" fill="white" />
            </g>
            <defs>
                <clipPath id="clip0_328_253">
                    <rect width="36" height="36" fill="white" />
                </clipPath>
            </defs>
        </svg>
        <h4><?= ucwords($org_name) ?> Registration</h4>
    </a>

<?php
    }
}