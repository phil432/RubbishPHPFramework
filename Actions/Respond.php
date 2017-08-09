<?php

require_once __dir__.'/../Routing/Actions.php';
require_once __dir__.'/Exceptions/ExceptionActions.php';
require_once __dir__.'/Admin/LoginPage/LoginPage.php';
require_once __dir__.'/Admin/PasswordReset/PasswordResetPage.php';
require_once __dir__.'/Admin/PasswordReset/SetNewPasswordPage.php';
require_once __dir__.'/Admin/Dashboard/Dashboard.php';
require_once __dir__.'/Static/FetchStaticActions.php';
require_once __dir__.'/Admin/Ajax/AuthoriseAdminUser.php';
require_once __dir__.'/Admin/Ajax/SaveBlog.php';
require_once __dir__.'/Admin/Ajax/DeleteBlog.php';
require_once __dir__.'/Admin/Ajax/SearchBlogs.php';
require_once __dir__.'/Admin/Ajax/UploadBlogMedia.php';
require_once __dir__.'/Admin/Ajax/Logout.php';
require_once __dir__.'/Admin/Ajax/PasswordResetAction.php';
require_once __dir__.'/Admin/Ajax/SetNewPassword.php';
require_once __dir__.'/Test/TestAction.php';
require_once __dir__.'/Blog/HomePageAction.php';
require_once __dir__.'/Blog/CoverPageAction.php';
require_once __dir__.'/Blog/FetchContactAction.php';
require_once __dir__.'/Blog/FetchArticleAction.php';
require_once __dir__.'/Blog/Ajax/ContactFormAction.php';

class Respond {

    static function go($actionString, $uriArray) {

        switch($actionString) {
            case PAGE_NOT_FOUND_ACTION:
                return ExceptionActions::pageNotFound();


            // All of the admin actions below
            case DISPLAY_ADMIN_LOGIN_PAGE_ACTION:
                return LoginPage::renderLoginPage();

            case PASSWORD_RESET_PAGE_ACTION:
                return PasswordResetPage::go();

            case SET_NEW_PASSWORD_PAGE:
                return SetNewPasswordPage::go($uriArray);

            case SHOW_ADMIN_DASHBOARD_ACTION:
                return Dashboard::showWelcomePage($uriArray);

            case LOAD_BLOG_EDIT_ACTION:
                return Dashboard::loadBlogEditPanel($uriArray);

            case LOAD_BLOG_EDIT_PANEL_ACTION:
                return Dashboard::loadBlogEditPanelWidget($uriArray);

            case BLOG_SEARCH_PANEL_ACTION:
                return Dashboard::loadBlogSearchPanel($uriArray);

            // All the static shit below
            case FETCH_GENERAL_STATIC_ACTION:
                return FetchStaticActions::fetchGeneralStatic($uriArray);

            case FETCH_CSS_ACTION:
                return FetchStaticActions::fetchCSSStatic($uriArray);

            case FETCH_JS_ACTION:
                return FetchStaticActions::fetchJSStatic($uriArray);

            case FETCH_ADMIN_STATIC_ACTION:
                return FetchStaticActions::fetchGeneralAdminStatic($uriArray);

            case FETCH_ADMIN_CSS_ACTION:
                return FetchStaticActions::fetchAdminCSSStatic($uriArray);

            case FETCH_ADMIN_JS_ACTION:
                return FetchStaticActions::fetchAdminJsStatic($uriArray);

            case FETCH_BLOGPOST_STATIC:
                return FetchStaticActions::fetchBlogPostStatic($uriArray);

            // Admin AJAX actions
            case AJAX_ADMIN_AUTH_USER_ACTION:
                return AuthoriseAdminUser::go();

            case AJAX_ADMIN_SAVE_BLOG_ACTION:
                return SaveBlog::go();

            case AJAX_ADMIN_DELETE_BLOG_ACTION:
                return DeleteBlog::go();

            case AJAX_ADMIN_SEARCH_BLOGS:
                return SearchBlogs::go();

            case AJAX_ADMIN_BLOG_MEDIA_UPLOAD:
                return UploadBlogMedia::go();

            case AJAX_ADMIN_LOGOUT_ACTION:
                return Logout::go();

            case AJAX_ADMIN_PASSWORD_RESET:
                return PasswordResetAction::go();

            case AJAX_ADMIN_SET_NEW_PASSWORD:
                return SetNewPassword::go();

            case TEST_ACTION:
                return TestAction::go($uriArray);

            // All the actual blog shit here
            case FETCH_HOME_PAGE:
                return HomePageAction::go();

            case FETCH_COVER_PAGE:
                return CoverPageAction::go();

            case FETCH_ARTICLE_PAGE_BY_ID:
                return FetchArticleAction::fetchById($uriArray);

            case FETCH_ARTICLE_PAGE_BY_SLUG:
                return FetchArticleAction::fetchBySlug($uriArray);

            case FETCH_ARTICLE_NOT_FOUND:
                return FetchArticleAction::fetchById(-1);

            case FETCH_CONTACT_PAGE:
                return FetchContactAction::go();

            case CONTACT_FORM_ACTION:
                return ContactFormAction::go();

            case PHP_INFO:
                return phpinfo();
        }
    }
}
