<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'vaibeqik_db' );

/** Username của database */
define( 'DB_USER', 'vaibeqik_user' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '91hSsdwAMR' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h+D%eZ7XRG),a;NIXNZoA?{T4]}DXEBq{mfDt!mwADtgq}Gj_|;5|w7UrRvVc{CF' );
define( 'SECURE_AUTH_KEY',  '/XsR?r||m4OnI4]!J`~Cu/&W~ryG_Ds@_JK$y}1]SAGo*KZ4lI&wyGp|PK;qD6' );
define( 'LOGGED_IN_KEY',    'y6|BC1JL)) it|`/GE.B(4Hg|T93os@U=.Tp~M.hlGVy5.awy//,}GAXB(d|c8U3' );
define( 'NONCE_KEY',        'Df|b+U`yR*&v8rx~ u,Z9]-/o i~yW:$Ww3:-Ym(GSCrYRcE[zU*x*s}!l<x  (1' );
define( 'AUTH_SALT',        ';4K;)3;EJuxBt_gdZyz0:j/y}SHJft>nGdGs47S[Kw9E]5^6UXN~J?wmxA3;]a$J' );
define( 'SECURE_AUTH_SALT', '29`=qh4W}pa^hM($>d54J<LoLx2mU H<N2CXt2)m;WRKyYP<yDxJWb)E-f`1]e#~' );
define( 'LOGGED_IN_SALT',   '_{U-j7Zm~`P|Z[F<TH$9jxpvKT,?Eu,|dGGvy%?cGV,_vD;E#i.I`Mc,U>SY.$B=' );
define( 'NONCE_SALT',       '`~.kl_oebK8BX)4hQ)`%D a-8znh;$ZbPiT-UK*6a^I4`CR 7,&Ve?PrwehKr[^=' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
