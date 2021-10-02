-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2021 at 09:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heygodb`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_ctr` (`p_trans_code` VARCHAR(20), `p_yr` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 BEGIN
                            DECLARE val INT;
                            DECLARE len INT;
                            DECLARE pre char(30);
                            DECLARE suf char(30);
                            DECLARE bch char(30);

                            SELECT current_value, counter_length, prefix, suffix 
                            INTO val, len, pre, suf		
                            FROM counter
                            WHERE counter_code COLLATE utf8mb4_general_ci = p_trans_code;

                            IF p_yr > CONVERT(suf, unsigned INTEGER) THEN
                                SET val = 1;
                            ELSE
                                SET val = val + 1;
                            END IF;

                            UPDATE counter
                            SET current_value = val,
                                suffix = p_yr
                            WHERE counter_code COLLATE utf8mb4_general_ci = p_trans_code;

                            RETURN CONCAT(pre,'-',bch,LPAD(CONVERT(val, CHAR(30)),len,'0'),'-',suf);
                            END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Baisac Andolino', 'dondonpentavia@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', '', '2021-08-20 16:00:00', '2021-08-20 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badge_request`
--

CREATE TABLE `badge_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_uploads_id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = open, 1 = approved, 2 = disapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `communication_app`
--

CREATE TABLE `communication_app` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communication_app`
--

INSERT INTO `communication_app` (`id`, `app_name`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Skype', '2021-06-02 16:00:00', '2021-06-02 16:00:00', 'skype.png'),
(2, 'Zoom', '2021-06-02 16:00:00', '2021-06-02 16:00:00', 'zoom.png');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `counter_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_value` int(11) NOT NULL DEFAULT 0,
  `counter_length` int(11) NOT NULL DEFAULT 0,
  `prefix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter_for`, `counter_code`, `current_value`, `counter_length`, `prefix`, `suffix`, `created_at`, `updated_at`) VALUES
(1, 'Students', 'INVS', 0, 8, 'INVS', '2021', NULL, NULL),
(2, 'Teachers', 'INVT', 0, 8, 'INVT', '2021', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `country_name`, `iso3`, `phonecode`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 'AFG', 93, NULL, NULL),
(2, 'AX', 'Aland Islands', 'ALA', 358, NULL, NULL),
(3, 'AL', 'Albania', 'ALB', 355, NULL, NULL),
(4, 'DZ', 'Algeria', 'DZA', 213, NULL, NULL),
(5, 'AS', 'American Samoa', 'ASM', 1684, NULL, NULL),
(6, 'AD', 'Andorra', 'AND', 376, NULL, NULL),
(7, 'AO', 'Angola', 'AGO', 244, NULL, NULL),
(8, 'AI', 'Anguilla', 'AIA', 1264, NULL, NULL),
(9, 'AQ', 'Antarctica', 'ATA', 0, NULL, NULL),
(10, 'AG', 'Antigua and Barbuda', 'ATG', 1268, NULL, NULL),
(11, 'AR', 'Argentina', 'ARG', 54, NULL, NULL),
(12, 'AM', 'Armenia', 'ARM', 374, NULL, NULL),
(13, 'AW', 'Aruba', 'ABW', 297, NULL, NULL),
(14, 'AU', 'Australia', 'AUS', 61, NULL, NULL),
(15, 'AT', 'Austria', 'AUT', 43, NULL, NULL),
(16, 'AZ', 'Azerbaijan', 'AZE', 994, NULL, NULL),
(17, 'BS', 'Bahamas', 'BHS', 1242, NULL, NULL),
(18, 'BH', 'Bahrain', 'BHR', 973, NULL, NULL),
(19, 'BD', 'Bangladesh', 'BGD', 880, NULL, NULL),
(20, 'BB', 'Barbados', 'BRB', 1246, NULL, NULL),
(21, 'BY', 'Belarus', 'BLR', 375, NULL, NULL),
(22, 'BE', 'Belgium', 'BEL', 32, NULL, NULL),
(23, 'BZ', 'Belize', 'BLZ', 501, NULL, NULL),
(24, 'BJ', 'Benin', 'BEN', 229, NULL, NULL),
(25, 'BM', 'Bermuda', 'BMU', 1441, NULL, NULL),
(26, 'BT', 'Bhutan', 'BTN', 975, NULL, NULL),
(27, 'BO', 'Bolivia', 'BOL', 591, NULL, NULL),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba', 'BES', 599, NULL, NULL),
(29, 'BA', 'Bosnia and Herzegovina', 'BIH', 387, NULL, NULL),
(30, 'BW', 'Botswana', 'BWA', 267, NULL, NULL),
(31, 'BV', 'Bouvet Island', 'BVT', 0, NULL, NULL),
(32, 'BR', 'Brazil', 'BRA', 55, NULL, NULL),
(33, 'IO', 'British Indian Ocean Territory', 'IOT', 246, NULL, NULL),
(34, 'BN', 'Brunei Darussalam', 'BRN', 673, NULL, NULL),
(35, 'BG', 'Bulgaria', 'BGR', 359, NULL, NULL),
(36, 'BF', 'Burkina Faso', 'BFA', 226, NULL, NULL),
(37, 'BI', 'Burundi', 'BDI', 257, NULL, NULL),
(38, 'KH', 'Cambodia', 'KHM', 855, NULL, NULL),
(39, 'CM', 'Cameroon', 'CMR', 237, NULL, NULL),
(40, 'CA', 'Canada', 'CAN', 1, NULL, NULL),
(41, 'CV', 'Cape Verde', 'CPV', 238, NULL, NULL),
(42, 'KY', 'Cayman Islands', 'CYM', 1345, NULL, NULL),
(43, 'CF', 'Central African Republic', 'CAF', 236, NULL, NULL),
(44, 'TD', 'Chad', 'TCD', 235, NULL, NULL),
(45, 'CL', 'Chile', 'CHL', 56, NULL, NULL),
(46, 'CN', 'China', 'CHN', 86, NULL, NULL),
(47, 'CX', 'Christmas Island', 'CXR', 61, NULL, NULL),
(48, 'CC', 'Cocos (Keeling) Islands', 'CCK', 672, NULL, NULL),
(49, 'CO', 'Colombia', 'COL', 57, NULL, NULL),
(50, 'KM', 'Comoros', 'COM', 269, NULL, NULL),
(51, 'CG', 'Congo', 'COG', 242, NULL, NULL),
(52, 'CD', 'Congo, the Democratic Republic of the', 'COD', 242, NULL, NULL),
(53, 'CK', 'Cook Islands', 'COK', 682, NULL, NULL),
(54, 'CR', 'Costa Rica', 'CRI', 506, NULL, NULL),
(55, 'CI', 'Cote D\'Ivoire', 'CIV', 225, NULL, NULL),
(56, 'HR', 'Croatia', 'HRV', 385, NULL, NULL),
(57, 'CU', 'Cuba', 'CUB', 53, NULL, NULL),
(58, 'CW', 'Curacao', 'CUW', 599, NULL, NULL),
(59, 'CY', 'Cyprus', 'CYP', 357, NULL, NULL),
(60, 'CZ', 'Czech Republic', 'CZE', 420, NULL, NULL),
(61, 'DK', 'Denmark', 'DNK', 45, NULL, NULL),
(62, 'DJ', 'Djibouti', 'DJI', 253, NULL, NULL),
(63, 'DM', 'Dominica', 'DMA', 1767, NULL, NULL),
(64, 'DO', 'Dominican Republic', 'DOM', 1809, NULL, NULL),
(65, 'EC', 'Ecuador', 'ECU', 593, NULL, NULL),
(66, 'EG', 'Egypt', 'EGY', 20, NULL, NULL),
(67, 'SV', 'El Salvador', 'SLV', 503, NULL, NULL),
(68, 'GQ', 'Equatorial Guinea', 'GNQ', 240, NULL, NULL),
(69, 'ER', 'Eritrea', 'ERI', 291, NULL, NULL),
(70, 'EE', 'Estonia', 'EST', 372, NULL, NULL),
(71, 'ET', 'Ethiopia', 'ETH', 251, NULL, NULL),
(72, 'FK', 'Falkland Islands (Malvinas)', 'FLK', 500, NULL, NULL),
(73, 'FO', 'Faroe Islands', 'FRO', 298, NULL, NULL),
(74, 'FJ', 'Fiji', 'FJI', 679, NULL, NULL),
(75, 'FI', 'Finland', 'FIN', 358, NULL, NULL),
(76, 'FR', 'France', 'FRA', 33, NULL, NULL),
(77, 'GF', 'French Guiana', 'GUF', 594, NULL, NULL),
(78, 'PF', 'French Polynesia', 'PYF', 689, NULL, NULL),
(79, 'TF', 'French Southern Territories', 'ATF', 0, NULL, NULL),
(80, 'GA', 'Gabon', 'GAB', 241, NULL, NULL),
(81, 'GM', 'Gambia', 'GMB', 220, NULL, NULL),
(82, 'GE', 'Georgia', 'GEO', 995, NULL, NULL),
(83, 'DE', 'Germany', 'DEU', 49, NULL, NULL),
(84, 'GH', 'Ghana', 'GHA', 233, NULL, NULL),
(85, 'GI', 'Gibraltar', 'GIB', 350, NULL, NULL),
(86, 'GR', 'Greece', 'GRC', 30, NULL, NULL),
(87, 'GL', 'Greenland', 'GRL', 299, NULL, NULL),
(88, 'GD', 'Grenada', 'GRD', 1473, NULL, NULL),
(89, 'GP', 'Guadeloupe', 'GLP', 590, NULL, NULL),
(90, 'GU', 'Guam', 'GUM', 1671, NULL, NULL),
(91, 'GT', 'Guatemala', 'GTM', 502, NULL, NULL),
(92, 'GG', 'Guernsey', 'GGY', 44, NULL, NULL),
(93, 'GN', 'Guinea', 'GIN', 224, NULL, NULL),
(94, 'GW', 'Guinea-Bissau', 'GNB', 245, NULL, NULL),
(95, 'GY', 'Guyana', 'GUY', 592, NULL, NULL),
(96, 'HT', 'Haiti', 'HTI', 509, NULL, NULL),
(97, 'HM', 'Heard Island and Mcdonald Islands', 'HMD', 0, NULL, NULL),
(98, 'VA', 'Holy See (Vatican City State)', 'VAT', 39, NULL, NULL),
(99, 'HN', 'Honduras', 'HND', 504, NULL, NULL),
(100, 'HK', 'Hong Kong', 'HKG', 852, NULL, NULL),
(101, 'HU', 'Hungary', 'HUN', 36, NULL, NULL),
(102, 'IS', 'Iceland', 'ISL', 354, NULL, NULL),
(103, 'IN', 'India', 'IND', 91, NULL, NULL),
(104, 'ID', 'Indonesia', 'IDN', 62, NULL, NULL),
(105, 'IR', 'Iran, Islamic Republic of', 'IRN', 98, NULL, NULL),
(106, 'IQ', 'Iraq', 'IRQ', 964, NULL, NULL),
(107, 'IE', 'Ireland', 'IRL', 353, NULL, NULL),
(108, 'IM', 'Isle of Man', 'IMN', 44, NULL, NULL),
(109, 'IL', 'Israel', 'ISR', 972, NULL, NULL),
(110, 'IT', 'Italy', 'ITA', 39, NULL, NULL),
(111, 'JM', 'Jamaica', 'JAM', 1876, NULL, NULL),
(112, 'JP', 'Japan', 'JPN', 81, NULL, NULL),
(113, 'JE', 'Jersey', 'JEY', 44, NULL, NULL),
(114, 'JO', 'Jordan', 'JOR', 962, NULL, NULL),
(115, 'KZ', 'Kazakhstan', 'KAZ', 7, NULL, NULL),
(116, 'KE', 'Kenya', 'KEN', 254, NULL, NULL),
(117, 'KI', 'Kiribati', 'KIR', 686, NULL, NULL),
(118, 'KP', 'Korea, Democratic People\"s Republic of', 'PRK', 850, NULL, NULL),
(119, 'KR', 'Korea, Republic of', 'KOR', 82, NULL, NULL),
(120, 'XK', 'Kosovo', 'XKX', 381, NULL, NULL),
(121, 'KW', 'Kuwait', 'KWT', 965, NULL, NULL),
(122, 'KG', 'Kyrgyzstan', 'KGZ', 996, NULL, NULL),
(123, 'LA', 'Lao People\'s Democratic Republic', 'LAO', 856, NULL, NULL),
(124, 'LV', 'Latvia', 'LVA', 371, NULL, NULL),
(125, 'LB', 'Lebanon', 'LBN', 961, NULL, NULL),
(126, 'LS', 'Lesotho', 'LSO', 266, NULL, NULL),
(127, 'LR', 'Liberia', 'LBR', 231, NULL, NULL),
(128, 'LY', 'Libyan Arab Jamahiriya', 'LBY', 218, NULL, NULL),
(129, 'LI', 'Liechtenstein', 'LIE', 423, NULL, NULL),
(130, 'LT', 'Lithuania', 'LTU', 370, NULL, NULL),
(131, 'LU', 'Luxembourg', 'LUX', 352, NULL, NULL),
(132, 'MO', 'Macao', 'MAC', 853, NULL, NULL),
(133, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 389, NULL, NULL),
(134, 'MG', 'Madagascar', 'MDG', 261, NULL, NULL),
(135, 'MW', 'Malawi', 'MWI', 265, NULL, NULL),
(136, 'MY', 'Malaysia', 'MYS', 60, NULL, NULL),
(137, 'MV', 'Maldives', 'MDV', 960, NULL, NULL),
(138, 'ML', 'Mali', 'MLI', 223, NULL, NULL),
(139, 'MT', 'Malta', 'MLT', 356, NULL, NULL),
(140, 'MH', 'Marshall Islands', 'MHL', 692, NULL, NULL),
(141, 'MQ', 'Martinique', 'MTQ', 596, NULL, NULL),
(142, 'MR', 'Mauritania', 'MRT', 222, NULL, NULL),
(143, 'MU', 'Mauritius', 'MUS', 230, NULL, NULL),
(144, 'YT', 'Mayotte', 'MYT', 269, NULL, NULL),
(145, 'MX', 'Mexico', 'MEX', 52, NULL, NULL),
(146, 'FM', 'Micronesia, Federated States of', 'FSM', 691, NULL, NULL),
(147, 'MD', 'Moldova, Republic of', 'MDA', 373, NULL, NULL),
(148, 'MC', 'Monaco', 'MCO', 377, NULL, NULL),
(149, 'MN', 'Mongolia', 'MNG', 976, NULL, NULL),
(150, 'ME', 'Montenegro', 'MNE', 382, NULL, NULL),
(151, 'MS', 'Montserrat', 'MSR', 1664, NULL, NULL),
(152, 'MA', 'Morocco', 'MAR', 212, NULL, NULL),
(153, 'MZ', 'Mozambique', 'MOZ', 258, NULL, NULL),
(154, 'MM', 'Myanmar', 'MMR', 95, NULL, NULL),
(155, 'NA', 'Namibia', 'NAM', 264, NULL, NULL),
(156, 'NR', 'Nauru', 'NRU', 674, NULL, NULL),
(157, 'NP', 'Nepal', 'NPL', 977, NULL, NULL),
(158, 'NL', 'Netherlands', 'NLD', 31, NULL, NULL),
(159, 'AN', 'Netherlands Antilles', 'ANT', 599, NULL, NULL),
(160, 'NC', 'New Caledonia', 'NCL', 687, NULL, NULL),
(161, 'NZ', 'New Zealand', 'NZL', 64, NULL, NULL),
(162, 'NI', 'Nicaragua', 'NIC', 505, NULL, NULL),
(163, 'NE', 'Niger', 'NER', 227, NULL, NULL),
(164, 'NG', 'Nigeria', 'NGA', 234, NULL, NULL),
(165, 'NU', 'Niue', 'NIU', 683, NULL, NULL),
(166, 'NF', 'Norfolk Island', 'NFK', 672, NULL, NULL),
(167, 'MP', 'Northern Mariana Islands', 'MNP', 1670, NULL, NULL),
(168, 'NO', 'Norway', 'NOR', 47, NULL, NULL),
(169, 'OM', 'Oman', 'OMN', 968, NULL, NULL),
(170, 'PK', 'Pakistan', 'PAK', 92, NULL, NULL),
(171, 'PW', 'Palau', 'PLW', 680, NULL, NULL),
(172, 'PS', 'Palestinian Territory, Occupied', 'PSE', 970, NULL, NULL),
(173, 'PA', 'Panama', 'PAN', 507, NULL, NULL),
(174, 'PG', 'Papua New Guinea', 'PNG', 675, NULL, NULL),
(175, 'PY', 'Paraguay', 'PRY', 595, NULL, NULL),
(176, 'PE', 'Peru', 'PER', 51, NULL, NULL),
(177, 'PH', 'Philippines', 'PHL', 63, NULL, NULL),
(178, 'PN', 'Pitcairn', 'PCN', 0, NULL, NULL),
(179, 'PL', 'Poland', 'POL', 48, NULL, NULL),
(180, 'PT', 'Portugal', 'PRT', 351, NULL, NULL),
(181, 'PR', 'Puerto Rico', 'PRI', 1787, NULL, NULL),
(182, 'QA', 'Qatar', 'QAT', 974, NULL, NULL),
(183, 'RE', 'Reunion', 'REU', 262, NULL, NULL),
(184, 'RO', 'Romania', 'ROM', 40, NULL, NULL),
(185, 'RU', 'Russian Federation', 'RUS', 70, NULL, NULL),
(186, 'RW', 'Rwanda', 'RWA', 250, NULL, NULL),
(187, 'BL', 'Saint Barthelemy', 'BLM', 590, NULL, NULL),
(188, 'SH', 'Saint Helena', 'SHN', 290, NULL, NULL),
(189, 'KN', 'Saint Kitts and Nevis', 'KNA', 1869, NULL, NULL),
(190, 'LC', 'Saint Lucia', 'LCA', 1758, NULL, NULL),
(191, 'MF', 'Saint Martin', 'MAF', 590, NULL, NULL),
(192, 'PM', 'Saint Pierre and Miquelon', 'SPM', 508, NULL, NULL),
(193, 'VC', 'Saint Vincent and the Grenadines', 'VCT', 1784, NULL, NULL),
(194, 'WS', 'Samoa', 'WSM', 684, NULL, NULL),
(195, 'SM', 'San Marino', 'SMR', 378, NULL, NULL),
(196, 'ST', 'Sao Tome and Principe', 'STP', 239, NULL, NULL),
(197, 'SA', 'Saudi Arabia', 'SAU', 966, NULL, NULL),
(198, 'SN', 'Senegal', 'SEN', 221, NULL, NULL),
(199, 'RS', 'Serbia', 'SRB', 381, NULL, NULL),
(200, 'CS', 'Serbia and Montenegro', 'SCG', 381, NULL, NULL),
(201, 'SC', 'Seychelles', 'SYC', 248, NULL, NULL),
(202, 'SL', 'Sierra Leone', 'SLE', 232, NULL, NULL),
(203, 'SG', 'Singapore', 'SGP', 65, NULL, NULL),
(204, 'SX', 'Sint Maarten', 'SXM', 1, NULL, NULL),
(205, 'SK', 'Slovakia', 'SVK', 421, NULL, NULL),
(206, 'SI', 'Slovenia', 'SVN', 386, NULL, NULL),
(207, 'SB', 'Solomon Islands', 'SLB', 677, NULL, NULL),
(208, 'SO', 'Somalia', 'SOM', 252, NULL, NULL),
(209, 'ZA', 'South Africa', 'ZAF', 27, NULL, NULL),
(210, 'GS', 'South Georgia and the South Sandwich Islands', 'SGS', 0, NULL, NULL),
(211, 'SS', 'South Sudan', 'SSD', 211, NULL, NULL),
(212, 'ES', 'Spain', 'ESP', 34, NULL, NULL),
(213, 'LK', 'Sri Lanka', 'LKA', 94, NULL, NULL),
(214, 'SD', 'Sudan', 'SDN', 249, NULL, NULL),
(215, 'SR', 'Suriname', 'SUR', 597, NULL, NULL),
(216, 'SJ', 'Svalbard and Jan Mayen', 'SJM', 47, NULL, NULL),
(217, 'SZ', 'Swaziland', 'SWZ', 268, NULL, NULL),
(218, 'SE', 'Sweden', 'SWE', 46, NULL, NULL),
(219, 'CH', 'Switzerland', 'CHE', 41, NULL, NULL),
(220, 'SY', 'Syrian Arab Republic', 'SYR', 963, NULL, NULL),
(221, 'TW', 'Taiwan, Province of China', 'TWN', 886, NULL, NULL),
(222, 'TJ', 'Tajikistan', 'TJK', 992, NULL, NULL),
(223, 'TZ', 'Tanzania, United Republic of', 'TZA', 255, NULL, NULL),
(224, 'TH', 'Thailand', 'THA', 66, NULL, NULL),
(225, 'TL', 'Timor-Leste', 'TLS', 670, NULL, NULL),
(226, 'TG', 'Togo', 'TGO', 228, NULL, NULL),
(227, 'TK', 'Tokelau', 'TKL', 690, NULL, NULL),
(228, 'TO', 'Tonga', 'TON', 676, NULL, NULL),
(229, 'TT', 'Trinidad and Tobago', 'TTO', 1868, NULL, NULL),
(230, 'TN', 'Tunisia', 'TUN', 216, NULL, NULL),
(231, 'TR', 'Turkey', 'TUR', 90, NULL, NULL),
(232, 'TM', 'Turkmenistan', 'TKM', 7370, NULL, NULL),
(233, 'TC', 'Turks and Caicos Islands', 'TCA', 1649, NULL, NULL),
(234, 'TV', 'Tuvalu', 'TUV', 688, NULL, NULL),
(235, 'UG', 'Uganda', 'UGA', 256, NULL, NULL),
(236, 'UA', 'Ukraine', 'UKR', 380, NULL, NULL),
(237, 'AE', 'United Arab Emirates', 'ARE', 971, NULL, NULL),
(238, 'GB', 'United Kingdom', 'GBR', 44, NULL, NULL),
(239, 'US', 'United States', 'USA', 1, NULL, NULL),
(240, 'UM', 'United States Minor Outlying Islands', 'UMI', 1, NULL, NULL),
(241, 'UY', 'Uruguay', 'URY', 598, NULL, NULL),
(242, 'UZ', 'Uzbekistan', 'UZB', 998, NULL, NULL),
(243, 'VU', 'Vanuatu', 'VUT', 678, NULL, NULL),
(244, 'VE', 'Venezuela', 'VEN', 58, NULL, NULL),
(245, 'VN', 'Viet Nam', 'VNM', 84, NULL, NULL),
(246, 'VG', 'Virgin Islands, British', 'VGB', 1284, NULL, NULL),
(247, 'VI', 'Virgin Islands, U.s.', 'VIR', 1340, NULL, NULL),
(248, 'WF', 'Wallis and Futuna', 'WLF', 681, NULL, NULL),
(249, 'EH', 'Western Sahara', 'ESH', 212, NULL, NULL),
(250, 'YE', 'Yemen', 'YEM', 967, NULL, NULL),
(251, 'ZM', 'Zambia', 'ZMB', 260, NULL, NULL),
(252, 'ZW', 'Zimbabwe', 'ZWE', 263, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency_rate`
--

CREATE TABLE `currency_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(12,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_rate`
--

INSERT INTO `currency_rate` (`id`, `rate`, `currency`, `created_at`, `updated_at`) VALUES
(1, '0.44', 'JPY', '2021-04-30 16:00:00', '2021-04-30 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `heygo_wallet`
--

CREATE TABLE `heygo_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `students_payment_log_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heygo_wallet`
--

INSERT INTO `heygo_wallet` (`id`, `students_payment_log_id`, `amount`, `created_at`, `updated_at`) VALUES
(28, 90, 206.54, '2021-09-29 16:48:11', NULL),
(29, 91, 270.30, '2021-09-29 17:17:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_level`
--

CREATE TABLE `language_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_option`
--

CREATE TABLE `lesson_option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_rate_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_count` int(11) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_option`
--

INSERT INTO `lesson_option` (`id`, `currency_rate_id`, `title`, `lesson_count`, `cost`, `created_at`, `updated_at`) VALUES
(1, 1, 'Trial Lesson', 300, '500.00', '2021-05-28 16:00:00', '2021-05-28 16:00:00'),
(2, 1, '1 Hour Lesson', 300, '1000.00', '2021-05-28 16:00:00', '2021-05-28 16:00:00'),
(3, 1, '30 Minutes Lesson (For Elementary Level)', 300, '1000.00', '2021-05-28 16:00:00', '2021-05-28 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan`
--

CREATE TABLE `lesson_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_of_lesson_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_closed` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 => Closed, 1 => Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_plan`
--

INSERT INTO `lesson_plan` (`id`, `type_of_lesson_id`, `title`, `body`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kindergarten', 'Kindergarten Enligsh', 1, '2021-06-02 16:00:00', NULL),
(2, 1, 'Lower Elementary English', 'Lower Elementary English', 1, '2021-06-02 16:00:00', NULL),
(3, 1, 'Upper Elementary English', 'Upper Elementary English', 1, '2021-06-02 16:00:00', NULL),
(4, 1, 'Junior High English', 'Junior High English', 1, '2021-06-02 16:00:00', NULL),
(5, 1, 'Senior High English', 'Senior High English', 1, '2021-06-02 16:00:00', NULL),
(6, 2, 'Basic English', 'Basic English', 1, '2021-06-02 16:00:00', NULL),
(7, 2, 'Conversional English', 'Conversional English', 1, '2021-06-02 16:00:00', NULL),
(8, 2, 'Business English', 'Business English', 1, '2021-06-02 16:00:00', NULL),
(9, 2, 'Advanced English', 'Advanced English', 1, '2021-06-02 16:00:00', NULL),
(10, 3, 'IELTS', 'IELTS', 1, '2021-06-02 16:00:00', NULL),
(11, 3, 'TOEFL', 'TOEFL', 1, '2021-06-02 16:00:00', NULL),
(12, 3, 'CAL', 'CAL', 1, '2021-06-02 16:00:00', NULL),
(13, 3, 'TESOL', 'TESOL', 1, '2021-06-02 16:00:00', NULL),
(14, 3, 'EIKEN', 'EIKEN', 1, '2021-06-02 16:00:00', NULL),
(15, 3, 'GTEC', 'GTEC', 1, '2021-06-02 16:00:00', NULL),
(16, 3, 'TEAP', 'TEAP', 1, '2021-06-02 16:00:00', NULL),
(17, 3, 'OET', 'OET', 1, '2021-06-02 16:00:00', NULL),
(18, 3, 'PIE', 'PIE', 1, '2021-06-02 16:00:00', NULL),
(19, 3, 'CALL', 'CALL', 1, '2021-06-02 16:00:00', NULL),
(20, 3, 'ICAS', 'ICAS', 1, '2021-06-02 16:00:00', NULL),
(21, 4, 'English for Travelling', 'English for Travelling', 1, '2021-06-02 16:00:00', NULL),
(22, 4, 'English for Studying Abroad', 'English for Studying Abroad', 1, '2021-06-02 16:00:00', NULL),
(23, 4, 'English for Work', 'English for Work', 1, '2021-06-02 16:00:00', NULL),
(24, 4, 'English Literature', 'English Literature', 1, '2021-06-02 16:00:00', NULL),
(25, 4, 'English for Interviews', 'English for Interviews', 1, '2021-06-02 16:00:00', NULL),
(26, 4, 'English for as Hobby', 'English for as Hobby', 1, '2021-06-02 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan_attachments`
--

CREATE TABLE `lesson_plan_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan_comments`
--

CREATE TABLE `lesson_plan_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED NOT NULL,
  `teachers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan_questionare`
--

CREATE TABLE `lesson_plan_questionare` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED NOT NULL,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plan_ratings`
--

CREATE TABLE `lesson_plan_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED NOT NULL,
  `rated_teachers_id` bigint(20) UNSIGNED NOT NULL,
  `rate` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 - 5 star, 5 is highest',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_rate_type`
--

CREATE TABLE `lesson_rate_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_rate_type`
--

INSERT INTO `lesson_rate_type` (`id`, `created_at`, `updated_at`, `type`, `rate`) VALUES
(1, NULL, NULL, 'Free', '0.00'),
(2, NULL, NULL, '30% of hour rate', '30.00'),
(3, NULL, NULL, '50% of hour rate', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_schedule`
--

CREATE TABLE `lesson_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED NOT NULL,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1 => open, 0 => cancel, 2 => re-schedule. Please check new_lesson_schedule_id field for new schedule, 3 = confirmed',
  `new_lesson_schedule_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lesson_option_id` bigint(20) UNSIGNED NOT NULL,
  `teachers_id` bigint(20) UNSIGNED NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_app_id` bigint(20) UNSIGNED DEFAULT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_schedule`
--

INSERT INTO `lesson_schedule` (`id`, `lesson_plan_id`, `students_id`, `lesson_date`, `status`, `new_lesson_schedule_id`, `created_at`, `updated_at`, `lesson_option_id`, `teachers_id`, `contact_no`, `communication_app_id`, `app_id`) VALUES
(120, 3, 4, NULL, 1, NULL, '2021-09-29 16:47:27', NULL, 1, 1, NULL, 2, '452452'),
(121, 3, 4, NULL, 1, NULL, '2021-09-29 16:48:12', NULL, 2, 1, NULL, 2, '4252'),
(122, 4, 4, NULL, 1, NULL, '2021-09-29 17:17:33', NULL, 1, 7, NULL, 2, '424242');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_schedule_details`
--

CREATE TABLE `lesson_schedule_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_schedule_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_schedule_details`
--

INSERT INTO `lesson_schedule_details` (`id`, `lesson_schedule_id`, `lesson_date`, `created_at`, `updated_at`) VALUES
(173, 120, '2021-09-16 01:30:00', '2021-09-29 16:47:27', NULL),
(174, 120, '2021-09-16 02:00:00', '2021-09-29 16:47:27', NULL),
(175, 121, '2021-09-14 02:00:00', '2021-09-29 16:48:12', NULL),
(176, 121, '2021-09-14 03:00:00', '2021-09-29 16:48:12', NULL),
(177, 122, '2021-09-15 02:00:00', '2021-09-29 17:17:33', NULL),
(178, 122, '2021-09-15 02:30:00', '2021-09-29 17:17:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_type_details`
--

CREATE TABLE `lesson_type_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_type_details`
--

INSERT INTO `lesson_type_details` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Regular English Lesson', 'Regular English Lesson (4 skills and grammar)', '2021-08-09 16:00:00', NULL),
(2, 'Conversation Practice', 'Conversation Practice', '2021-08-09 16:00:00', NULL),
(3, 'Test/Exam Preparation', 'Test/Exam Preparation', '2021-08-09 16:00:00', NULL),
(4, 'English for Travelling', 'English for Travelling', '2021-08-09 16:00:00', NULL),
(5, 'English for Studying Abroad', 'English for Studying Abroad', '2021-08-09 16:00:00', NULL),
(6, 'English for work', 'English for work (Interviews, etc.)', '2021-08-09 16:00:00', NULL),
(7, 'English Literation', 'English Literation', '2021-08-09 16:00:00', NULL),
(8, 'Others', 'Others', '2021-08-09 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_14_101629_create_todos_table', 1),
(5, '2021_04_01_142302_user_types', 1),
(6, '2021_04_01_143655_modify_users_add_user_types_id', 1),
(7, '2021_04_01_150253_create_type_of_lesson_table', 1),
(8, '2021_04_01_152801_create_school_year_table', 1),
(9, '2021_04_01_153357_create_language_level_table', 1),
(10, '2021_04_01_153754_create_countries_table', 1),
(11, '2021_04_01_153755_create_teachers_table', 1),
(12, '2021_04_01_153756_add_column_is_published_teachers_table', 1),
(13, '2021_04_01_162100_create_badges_table', 1),
(14, '2021_04_01_162126_create_teacher_badges_table', 1),
(15, '2021_04_01_164044_create_upload_types_table', 1),
(16, '2021_04_01_164231_create_teacher_uploads_table', 1),
(17, '2021_04_01_164556_create_badge_request_table', 1),
(18, '2021_04_01_165512_create_teacher_availability_table', 1),
(19, '2021_04_01_170127_create_teacher_banks_table', 1),
(20, '2021_04_01_170354_create_teacher_lesson_history_table', 1),
(21, '2021_04_01_170948_create_teacher_followers_table', 1),
(22, '2021_04_05_144105_create_students_table', 1),
(23, '2021_04_05_144106_create_teacher_newsfeed_table', 1),
(24, '2021_04_05_152917_create_teacher_newsfeed_comments_table', 1),
(25, '2021_04_05_153347_create_teacher_newsfeed_attachments_table', 1),
(26, '2021_04_05_160344_create_teacher_newsfeed_likes_table', 1),
(27, '2021_04_05_161641_create_lesson_plan_table', 1),
(28, '2021_04_05_162303_create_lesson_plan_attachments_table', 1),
(29, '2021_04_05_162523_create_lesson_plan_ratings_table', 1),
(30, '2021_04_05_162852_create_lesson_plan_comments_table', 1),
(31, '2021_04_05_165422_create_lesson_plan_questionare_table', 1),
(32, '2021_04_05_170514_create_lesson_schedule_table', 1),
(33, '2021_04_05_173352_create_notification_table', 1),
(34, '2021_04_08_084909_create_sessions_table', 1),
(36, '2021_05_18_155542_modify_teachers_table_add_contact_no', 3),
(37, '2021_06_01_072851_create_currency_rate', 4),
(38, '2021_06_01_072852_create_lesson_option', 5),
(39, '2021_06_01_091929_modify_lesson_schedule', 6),
(40, '2021_06_01_092758_modify_lesson_schedule_drop_fk_lesson_plan_id', 7),
(41, '2021_06_07_081933_create_table_student_banks', 8),
(42, '2021_06_08_082617_modify_students_table', 9),
(43, '2021_06_08_082843_modify_students_table', 10),
(44, '2021_06_14_053958_create_lesson_rate_type', 11),
(46, '2021_06_14_055730_modify_teachers_table_add_fk_lesson_type_rate_id', 12),
(48, '2021_06_14_060341_modify_lesson_rate_type_add_column_type_and_rate', 13),
(49, '2021_06_14_064450_modify_lesson_plan_teachers_id_fk', 14),
(50, '2021_06_14_064720_modify_teachers_table_add_lesson_plan_id_fk', 15),
(51, '2021_06_14_103249_modify_teachers_add_currency_rate_id', 16),
(53, '2021_06_16_045314_create_communication_app', 17),
(54, '2021_06_16_045458_modify_lesson_schedule_add_communication_app_id_fk', 18),
(55, '2021_06_16_085614_modify_com_app_add_image_ico', 19),
(56, '2021_07_05_013628_modify_students_add_about_me', 20),
(58, '2021_07_05_133045_create_lesson_schedule_details', 21),
(59, '2021_07_05_134017_modify_lesson_schedule_schedule_date_must_be_null', 22),
(61, '2021_07_05_172411_modify_lesson_schedule_add_confirmed_status_comment_1', 23),
(64, '2021_08_08_234355_modify_teacher_availability_add_status', 24),
(65, '2021_08_09_181025_modify_teacher_availability_change_add_field', 25),
(66, '2021_08_09_181336_modify_teacher_availability_modify_column_arrangement', 26),
(67, '2021_08_09_191152_modify_teacher_availability_modify_add_lesson_plan_id', 27),
(69, '2021_08_14_132529_create_students_level', 28),
(70, '2021_08_14_132528_create_lesson_type_details', 29),
(71, '2021_08_14_132527_create_students_test_preparation', 30),
(72, '2021_08_14_132526_create_students_english_level', 31),
(73, '2021_08_14_132525_create_students_date_plan', 32),
(74, '2021_08_20_151430_create_students_pref', 33),
(75, '2021_08_25_150222_create_students_payment_log', 34),
(76, '2021_08_25_161630_modify_students_payment_log', 35),
(77, '2021_08_25_162303_modify_students_payment_log_add_col_trans_type', 36),
(78, '2021_08_25_214409_modify_students_payment_log_add_col_refund_amount', 37),
(79, '2021_08_26_001316_modify_students_payment_log_add_col_currency', 38),
(80, '2021_08_26_144116_modify_students_payment_log_add_col_charge_id', 39),
(81, '2021_08_29_170302_create_admins', 40),
(82, '2021_09_06_013756_modify_teachers_add_stripe_id', 41),
(83, '2021_09_07_000211_create_counter', 42),
(85, '2021_09_07_005935_make_proceedure_fn_get_ctr', 43),
(86, '2021_09_07_011350_make_value_fn_get_ctr', 44),
(87, '2021_09_06_135226_create_heygo_wallet', 45),
(89, '2021_09_12_212153_modify_students_pref_add_teachers_id', 47),
(90, '2021_09_12_233538_modify_students_pref_add_lesson_schedule_id', 48),
(91, '2021_07_05_171954_modify_lesson_schedule_add_confirmed_status_comment', 49),
(92, '2021_09_15_033050_create_teachers_wallet', 50),
(93, '2021_09_15_042508_modify_lesson_schedule_status_default_to_1', 51),
(94, '2021_09_20_145856_modify_students_pref_add_lesson_option_id', 52);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teachers_id` bigint(20) UNSIGNED NOT NULL COMMENT 'teachers that notify',
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GSxSyj0S99UPGZ4klBMnOpNBqHlcjQaJAgvhsoOc', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzhFOEpWSTdHdnZzcmI0VUMzb09kdnNGNFg4czFtUm1GRW9lNXdKdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3QvaGV5Z28vc3R1ZGVudHMiO31zOjU1OiJsb2dpbl9zdHVkZW50c181OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1632940725),
('NbtAd37SCMDtlOBW4UkCtwVh5WSVgko3TVqRr7wF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFdzSjBDQW1hTU1rOU9sQzhVbGNnWVhucXRvRHRMdWIybkpaenpiNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9sb2NhbGhvc3QvaGV5Z28iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1633159757);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `lastname`, `firstname`, `middlename`, `country_id`, `email`, `username`, `password`, `is_active`, `is_verified`, `remember_token`, `created_at`, `updated_at`, `contact_no`, `about_me`) VALUES
(1, NULL, NULL, NULL, NULL, 'donstudents@gmail.com', NULL, '$2y$10$6Xjst09vOPgS8O8G3gm8iOXDQCrTgsvjxGiq3nGtR3qr6HSoxi2pC', 0, 0, NULL, '2021-04-10 23:06:50', '2021-04-10 23:06:50', NULL, NULL),
(2, NULL, NULL, NULL, NULL, 'andolino@gmail.com', NULL, '$2y$10$RiPDWlH1tv7.VhOwt9ibGuVkGEmCJemgQ6TnlZRRQw5QxCpOqJVHe', 0, 0, NULL, '2021-04-11 06:07:15', '2021-04-11 06:07:15', NULL, NULL),
(3, NULL, NULL, NULL, NULL, 'user1@gmail.com', NULL, '$2y$10$yzpMXEEFYwkl/zgTbpWaPOOxq9OxmqdBm93kGytsjiPDDryBVwYiC', 0, 0, NULL, '2021-04-25 03:08:02', '2021-04-25 03:08:02', NULL, NULL),
(4, 'Dela Cruz', 'Juan', NULL, 177, 'dondonpentavia@gmail.com', NULL, '$2y$10$/4WT2wDCgstrsNk7CMS4v.HVMLW1D2VsNC.ebBgJ9GkS.OkFWW.oq', 0, 1, NULL, '2021-04-25 04:28:54', '2021-07-04 17:46:27', '09773636444', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut est excepturi ut! Quaerat labore corporis distinctio magni iste, autem provident enim fuga? Sapiente eius similique aspernatur ullam maxime ex pariatur.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut est excepturi ut! Quaerat labore corporis distinctio magni iste, autem provident enim fuga? Sapiente eius similique aspernatur ullam maxime ex pariatur.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Aut est excepturi ut! Quaerat labore corporis distinctio magni iste, autem provident enim fuga? Sapiente eius similique aspernatur ullam maxime ex pariatur.'),
(18, NULL, NULL, NULL, NULL, 'dpentavia@gmail.com', NULL, '$2y$10$2aVcy2QOtYAEnjYz/VfbcORU5qx6NHDkYUZEfx4qPUhwZC9ErMS.6', 0, 1, NULL, '2021-09-11 22:35:21', '2021-09-11 22:35:36', NULL, NULL),
(19, NULL, NULL, NULL, NULL, 'baisac.andolino@gmail.com', NULL, '$2y$10$E1LvSQCY0akYsrpCtbkE8eS130qHPp0WdZgcpP.cGosj42kBSbJom', 0, 0, NULL, '2021-09-15 12:27:06', '2021-09-15 12:27:06', NULL, NULL),
(20, NULL, NULL, NULL, NULL, 'baisac@gmail.com', NULL, '$2y$10$KLwtyhjhwgCJ7j7ewsYLGekN7WJnmrZKX6UaT11L9PBcogT4kVYVu', 0, 1, NULL, '2021-09-15 12:27:49', '2021-09-15 12:28:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_date_plan`
--

CREATE TABLE `students_date_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_date_plan`
--

INSERT INTO `students_date_plan` (`id`, `text`, `created_at`, `updated_at`) VALUES
(1, '2-3 times a week', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(2, 'Once a week', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(3, 'Once every 2weeks', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(4, 'Once a month', '2021-08-09 16:00:00', '2021-08-09 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students_english_level`
--

CREATE TABLE `students_english_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_english_level`
--

INSERT INTO `students_english_level` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Beginner', '2021-08-09 16:00:00', NULL),
(2, 'Upper Beginner', '2021-08-09 16:00:00', NULL),
(3, 'Intermediate', '2021-08-09 16:00:00', NULL),
(4, 'Upper Intermediate', '2021-08-09 16:00:00', NULL),
(5, 'Advanced', '2021-08-09 16:00:00', NULL),
(6, 'Proficient', '2021-08-09 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_level`
--

CREATE TABLE `students_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_range_from` int(11) DEFAULT NULL,
  `age_range_to` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_level`
--

INSERT INTO `students_level` (`id`, `level`, `age_range_from`, `age_range_to`, `created_at`, `updated_at`) VALUES
(1, 'Kindergarten', 4, 6, '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(2, 'Lower Elementary', 6, 8, '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(3, 'Upper Elementary', 9, 11, '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(4, 'Junior High', 12, 15, '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(5, 'Senior High', 15, 18, '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(6, 'Adult', 18, 0, '2021-08-09 16:00:00', '2021-08-09 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students_payment_log`
--

CREATE TABLE `students_payment_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_schedule_id` bigint(20) UNSIGNED NOT NULL,
  `response_date` datetime NOT NULL,
  `is_invalid` tinyint(4) NOT NULL DEFAULT 0,
  `trans_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `refund_amount` double(8,2) DEFAULT NULL,
  `currency` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trans_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_payment_log`
--

INSERT INTO `students_payment_log` (`id`, `lesson_schedule_id`, `response_date`, `is_invalid`, `trans_id`, `user_id`, `charge_id`, `amount`, `refund_amount`, `currency`, `created_at`, `updated_at`, `trans_type`) VALUES
(90, 121, '2021-09-30 00:48:11', 0, 'txn_3Jf5x1IPbTk1H6nO0qoHXTUs', 'ch_3Jf5x1IPbTk1H6nO0Fc9WLyP', NULL, 1376.94, NULL, 'USD', NULL, NULL, 'charge'),
(91, 122, '2021-09-30 01:17:33', 0, 'txn_3Jf6PRIPbTk1H6nO0nP2wEwM', 'ch_3Jf6PRIPbTk1H6nO0KK6L547', NULL, 1802.00, NULL, 'USD', NULL, NULL, 'charge');

-- --------------------------------------------------------

--
-- Table structure for table `students_pref`
--

CREATE TABLE `students_pref` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `students_id` bigint(20) UNSIGNED NOT NULL,
  `students_level_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_type_details_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `students_test_preparation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `test_prep_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `students_english_level_id` bigint(20) UNSIGNED NOT NULL,
  `students_date_plan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teachers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_schedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_option_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_pref`
--

INSERT INTO `students_pref` (`id`, `students_id`, `students_level_id`, `lesson_type_details_id`, `students_test_preparation_id`, `test_prep_message`, `students_english_level_id`, `students_date_plan_id`, `created_at`, `updated_at`, `teachers_id`, `lesson_schedule_id`, `lesson_option_id`) VALUES
(43, 4, 2, '4', NULL, NULL, 5, 3, NULL, NULL, 7, 122, 1),
(45, 4, 2, '5', NULL, NULL, 4, 3, NULL, NULL, 1, 120, 1),
(46, 4, 1, '3', 8, NULL, 3, 3, NULL, NULL, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_test_preparation`
--

CREATE TABLE `students_test_preparation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_test_preparation`
--

INSERT INTO `students_test_preparation` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 'IELTS', 'IELTS', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(2, 'TOEFL', 'TOEFL', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(3, 'CAL', 'CAL', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(4, 'TESOL', 'TESOL', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(5, 'EIKEN', 'EIKEN', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(6, 'GTEC', 'GTEC', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(7, 'TEAP', 'TEAP', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(8, 'OET', 'OET', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(9, 'PIE', 'PIE', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(10, 'CALL', 'CALL', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(11, 'ICAS', 'ICAS', '2021-08-09 16:00:00', '2021-08-09 16:00:00'),
(12, 'Others', 'Others', '2021-08-09 16:00:00', '2021-08-09 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_banks`
--

CREATE TABLE `student_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acct_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_banks`
--

INSERT INTO `student_banks` (`id`, `student_id`, `bank`, `acct_no`, `created_at`, `updated_at`) VALUES
(1, 4, 'Eastwest', '2222', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_per_hr` decimal(12,2) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objective_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objective_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_rate_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `currency_rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `lastname`, `firstname`, `middlename`, `rate_per_hr`, `country_id`, `email`, `username`, `password`, `objective_title`, `objective_text`, `is_active`, `is_verified`, `remember_token`, `created_at`, `updated_at`, `contact_no`, `lesson_rate_type_id`, `lesson_plan_id`, `currency_rate_id`, `stripe_id`) VALUES
(1, 'pentavia', 'dondon', NULL, '1299.00', 17, 'dpentavia@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'ur adipisicing elit. Itaque', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque molestiae quae, adipisci ducimus quo tenetur eligendi corporis dignissimos maiores eius culpa suscipit sequi optio magnam, ex expedita aliquid? Possimus, deserunt. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque molestiae quae, adipisci ducimus quo tenetur eligendi corporis dignissimos maiores eius culpa suscipit sequi optio magnam, ex expedita aliquid? Possimus, deserunt.', 0, 0, NULL, '2021-04-10 02:31:19', '2021-09-28 08:56:01', '097736354623', 1, 3, 1, NULL),
(2, 'harden', 'james', NULL, '130.00', 16, 'donteacher@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'facere hic molestias facilis soluta. D', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe excepturi facere hic molestias facilis soluta. Dolorem ratione facere veritatis mollitia assumenda, cum cupiditate repudiandae asperiores placeat eligendi animi dolore nostrum.', 0, 0, NULL, '2021-04-10 23:07:33', '2021-09-29 17:24:35', '097723774654', 1, 4, 1, NULL),
(3, 'de leon', 'jane', NULL, NULL, 172, 'donteachersss@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'nt at architecto, dicta cupiditate', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt at architecto, dicta cupiditate esse quam obcaecati quidem asperiores illum nihil vero consequuntur expedita tenetur aperiam, accusamus cum? Vel, quidem autem.', 0, 0, NULL, '2021-04-10 23:09:25', '2021-05-18 09:54:26', '09773656715', NULL, NULL, NULL, NULL),
(4, 'baisac', 'jane', NULL, '255.00', 67, 'andolino@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'ur voluptatibus quidem natus se', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur voluptatibus quidem natus sed sint placeat ea suscipit eligendi quis? Iusto sapiente perspiciatis blanditiis ut atque quis, sint quibusdam ad eligendi.', 0, 0, NULL, '2021-04-10 23:11:02', '2021-09-29 17:30:05', '09772636465', 1, 2, 1, NULL),
(5, 'manaloto', 'joel', NULL, NULL, 168, 'dpentavia06@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'nam id nulla doloribus molestias a', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero eos magnam id nulla doloribus molestias aperiam assumenda autem eius voluptas porro sed ex, at ad rem nostrum commodi suscipit! Dignissimos. nam id nulla doloribus molestias a', 0, 0, NULL, '2021-04-11 02:10:36', '2021-05-18 09:57:00', '09772662346', NULL, NULL, NULL, NULL),
(6, 'casera', 'queenie', NULL, '622.00', 42, 'andolino06@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'e mollitia porro rerum eaque quasi o', 'Lorem, ipsum dolor sit amet  in illo doloremque mollitia porro  in illo doloremque mollitia porro  in illo doloremque mollitia porro rerurerureruconsectetur adipisicing elit. Accusamus, ipsa in illo doloremque mollitia porro rerum eaque quasi odio quidem optio distinctio earum laboriosam debitis repudiandae? Molestiae culpa repellat deserunt.', 0, 0, NULL, '2021-04-11 02:13:31', '2021-09-29 17:33:14', '09772636646', 1, 14, 1, NULL),
(7, 'Baisac', 'Andolino', NULL, '3400.00', 177, 'dondonpentavia@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 'poris nemo cupiditate ex tenetur, enim ei', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat provident corporis nemo cupiditate ex tenetur, enim eius autem accusantium optio, quia similique expedita mollitia dolores neque nam quisquam iure vel.', 0, 0, NULL, '2021-04-18 19:22:47', '2021-09-28 19:01:15', '09773656715', 3, 4, 1, 'cus_KAlvaLxIFt18Ay'),
(8, 'Magdangal', 'Julina', NULL, '1200.00', 10, 'user1@gmail.com', NULL, '$2y$10$jiuoBlJmA/3RO1O1XT2tJOaiBoiV8y7J250UKKVtUmWLBn.l6nwhi', 't obcaecati adipisci earum qui, ap', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quaerat, fugit obcaecati adipisci earum qui, aperiam, maiores veritatis tempore in at iste. Cum, autem. Unde quia voluptatem tempora cum illo.', 0, 0, NULL, '2021-04-25 03:07:31', '2021-09-29 17:33:54', '0982234474', 1, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_wallet`
--

CREATE TABLE `teachers_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `students_payment_log_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers_wallet`
--

INSERT INTO `teachers_wallet` (`id`, `students_payment_log_id`, `amount`, `created_at`, `updated_at`) VALUES
(28, 90, 1170.40, '2021-09-29 16:48:11', NULL),
(29, 91, 1531.70, '2021-09-29 17:17:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_availability`
--

CREATE TABLE `teacher_availability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Open, 1 = Requested, 2 = Booked, 3 = Closed',
  `lesson_plan_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_availability`
--

INSERT INTO `teacher_availability` (`id`, `teacher_id`, `start_time`, `end_time`, `created_at`, `updated_at`, `status`, `lesson_plan_id`) VALUES
(51, 7, '2021-09-12 00:00:00', '2021-09-12 00:30:00', NULL, NULL, 0, NULL),
(52, 7, '2021-09-12 00:30:00', '2021-09-12 01:00:00', NULL, NULL, 0, NULL),
(53, 7, '2021-09-12 01:00:00', '2021-09-12 01:30:00', NULL, NULL, 0, NULL),
(54, 7, '2021-09-12 01:30:00', '2021-09-12 02:00:00', NULL, NULL, 0, NULL),
(55, 7, '2021-09-12 02:00:00', '2021-09-12 02:30:00', NULL, NULL, 0, NULL),
(56, 7, '2021-09-12 02:30:00', '2021-09-12 03:00:00', NULL, NULL, 0, NULL),
(57, 7, '2021-09-12 03:00:00', '2021-09-12 03:30:00', NULL, NULL, 0, NULL),
(58, 7, '2021-09-12 03:30:00', '2021-09-12 04:00:00', NULL, NULL, 0, NULL),
(59, 7, '2021-09-12 04:00:00', '2021-09-12 04:30:00', NULL, NULL, 0, NULL),
(60, 7, '2021-09-12 04:30:00', '2021-09-12 05:00:00', NULL, NULL, 0, NULL),
(61, 7, '2021-09-12 05:00:00', '2021-09-12 05:30:00', NULL, NULL, 0, NULL),
(62, 7, '2021-09-12 05:30:00', '2021-09-12 06:00:00', NULL, NULL, 0, NULL),
(63, 7, '2021-09-13 00:00:00', '2021-09-13 00:30:00', NULL, NULL, 0, NULL),
(64, 7, '2021-09-13 00:30:00', '2021-09-13 01:00:00', NULL, NULL, 0, NULL),
(65, 7, '2021-09-13 01:00:00', '2021-09-13 01:30:00', NULL, NULL, 0, NULL),
(66, 7, '2021-09-13 01:30:00', '2021-09-13 02:00:00', NULL, NULL, 0, NULL),
(67, 7, '2021-09-13 02:00:00', '2021-09-13 02:30:00', NULL, NULL, 0, NULL),
(68, 7, '2021-09-13 02:30:00', '2021-09-13 03:00:00', NULL, NULL, 0, NULL),
(69, 7, '2021-09-13 03:00:00', '2021-09-13 03:30:00', NULL, NULL, 0, NULL),
(70, 7, '2021-09-13 03:30:00', '2021-09-13 04:00:00', NULL, NULL, 0, NULL),
(71, 7, '2021-09-13 04:00:00', '2021-09-13 04:30:00', NULL, NULL, 0, NULL),
(72, 7, '2021-09-13 04:30:00', '2021-09-13 05:00:00', NULL, NULL, 0, NULL),
(73, 7, '2021-09-13 05:00:00', '2021-09-13 05:30:00', NULL, NULL, 0, NULL),
(74, 7, '2021-09-13 05:30:00', '2021-09-13 06:00:00', NULL, NULL, 0, NULL),
(75, 7, '2021-09-14 00:00:00', '2021-09-14 00:30:00', NULL, NULL, 0, NULL),
(76, 7, '2021-09-14 00:30:00', '2021-09-14 01:00:00', NULL, NULL, 0, NULL),
(77, 7, '2021-09-14 01:00:00', '2021-09-14 01:30:00', NULL, NULL, 0, NULL),
(78, 7, '2021-09-14 01:30:00', '2021-09-14 02:00:00', NULL, NULL, 0, NULL),
(79, 7, '2021-09-14 02:00:00', '2021-09-14 02:30:00', NULL, NULL, 0, NULL),
(80, 7, '2021-09-14 02:30:00', '2021-09-14 03:00:00', NULL, NULL, 0, NULL),
(81, 7, '2021-09-14 03:00:00', '2021-09-14 03:30:00', NULL, NULL, 0, NULL),
(82, 7, '2021-09-14 03:30:00', '2021-09-14 04:00:00', NULL, NULL, 0, NULL),
(83, 7, '2021-09-14 04:00:00', '2021-09-14 04:30:00', NULL, NULL, 0, NULL),
(84, 7, '2021-09-14 04:30:00', '2021-09-14 05:00:00', NULL, NULL, 0, NULL),
(85, 7, '2021-09-14 05:00:00', '2021-09-14 05:30:00', NULL, NULL, 0, NULL),
(86, 7, '2021-09-14 05:30:00', '2021-09-14 06:00:00', NULL, NULL, 0, NULL),
(87, 7, '2021-09-15 00:00:00', '2021-09-15 00:30:00', NULL, NULL, 0, NULL),
(88, 7, '2021-09-15 00:30:00', '2021-09-15 01:00:00', NULL, NULL, 0, NULL),
(89, 7, '2021-09-15 01:00:00', '2021-09-15 01:30:00', NULL, NULL, 0, NULL),
(90, 7, '2021-09-15 01:30:00', '2021-09-15 02:00:00', NULL, NULL, 0, NULL),
(91, 7, '2021-09-15 02:00:00', '2021-09-15 02:30:00', NULL, NULL, 0, NULL),
(92, 7, '2021-09-15 02:30:00', '2021-09-15 03:00:00', NULL, NULL, 0, NULL),
(93, 7, '2021-09-15 03:00:00', '2021-09-15 03:30:00', NULL, NULL, 0, NULL),
(94, 7, '2021-09-15 03:30:00', '2021-09-15 04:00:00', NULL, NULL, 0, NULL),
(95, 7, '2021-09-15 04:00:00', '2021-09-15 04:30:00', NULL, NULL, 0, NULL),
(96, 7, '2021-09-15 04:30:00', '2021-09-15 05:00:00', NULL, NULL, 0, NULL),
(97, 7, '2021-09-15 05:00:00', '2021-09-15 05:30:00', NULL, NULL, 0, NULL),
(98, 7, '2021-09-15 05:30:00', '2021-09-15 06:00:00', NULL, NULL, 0, NULL),
(99, 7, '2021-09-16 00:00:00', '2021-09-16 00:30:00', NULL, NULL, 0, NULL),
(100, 7, '2021-09-16 00:30:00', '2021-09-16 01:00:00', NULL, NULL, 0, NULL),
(101, 7, '2021-09-16 01:00:00', '2021-09-16 01:30:00', NULL, NULL, 0, NULL),
(102, 7, '2021-09-16 01:30:00', '2021-09-16 02:00:00', NULL, NULL, 0, NULL),
(103, 7, '2021-09-16 02:00:00', '2021-09-16 02:30:00', NULL, NULL, 0, NULL),
(104, 7, '2021-09-16 02:30:00', '2021-09-16 03:00:00', NULL, NULL, 0, NULL),
(105, 7, '2021-09-16 03:00:00', '2021-09-16 03:30:00', NULL, NULL, 0, NULL),
(106, 7, '2021-09-16 03:30:00', '2021-09-16 04:00:00', NULL, NULL, 0, NULL),
(107, 7, '2021-09-16 04:00:00', '2021-09-16 04:30:00', NULL, NULL, 0, NULL),
(108, 7, '2021-09-16 04:30:00', '2021-09-16 05:00:00', NULL, NULL, 0, NULL),
(109, 7, '2021-09-16 05:00:00', '2021-09-16 05:30:00', NULL, NULL, 0, NULL),
(110, 7, '2021-09-16 05:30:00', '2021-09-16 06:00:00', NULL, NULL, 0, NULL),
(111, 7, '2021-09-17 00:00:00', '2021-09-17 00:30:00', NULL, NULL, 0, NULL),
(112, 7, '2021-09-17 00:30:00', '2021-09-17 01:00:00', NULL, NULL, 0, NULL),
(113, 7, '2021-09-17 01:00:00', '2021-09-17 01:30:00', NULL, NULL, 0, NULL),
(114, 7, '2021-09-17 01:30:00', '2021-09-17 02:00:00', NULL, NULL, 0, NULL),
(115, 7, '2021-09-17 02:00:00', '2021-09-17 02:30:00', NULL, NULL, 0, NULL),
(116, 7, '2021-09-17 02:30:00', '2021-09-17 03:00:00', NULL, NULL, 0, NULL),
(117, 7, '2021-09-17 03:00:00', '2021-09-17 03:30:00', NULL, NULL, 0, NULL),
(118, 7, '2021-09-17 03:30:00', '2021-09-17 04:00:00', NULL, NULL, 0, NULL),
(119, 7, '2021-09-17 04:00:00', '2021-09-17 04:30:00', NULL, NULL, 0, NULL),
(120, 7, '2021-09-17 04:30:00', '2021-09-17 05:00:00', NULL, NULL, 0, NULL),
(121, 7, '2021-09-17 05:00:00', '2021-09-17 05:30:00', NULL, NULL, 0, NULL),
(122, 7, '2021-09-17 05:30:00', '2021-09-17 06:00:00', NULL, NULL, 0, NULL),
(123, 1, '2021-09-12 00:00:00', '2021-09-12 00:30:00', NULL, NULL, 0, NULL),
(124, 1, '2021-09-12 00:30:00', '2021-09-12 01:00:00', NULL, NULL, 0, NULL),
(125, 1, '2021-09-12 01:00:00', '2021-09-12 01:30:00', NULL, NULL, 0, NULL),
(126, 1, '2021-09-12 01:30:00', '2021-09-12 02:00:00', NULL, NULL, 0, NULL),
(127, 1, '2021-09-12 02:00:00', '2021-09-12 02:30:00', NULL, NULL, 0, NULL),
(128, 1, '2021-09-12 02:30:00', '2021-09-12 03:00:00', NULL, NULL, 0, NULL),
(129, 1, '2021-09-12 03:00:00', '2021-09-12 03:30:00', NULL, NULL, 0, NULL),
(130, 1, '2021-09-12 03:30:00', '2021-09-12 04:00:00', NULL, NULL, 0, NULL),
(131, 1, '2021-09-12 04:00:00', '2021-09-12 04:30:00', NULL, NULL, 0, NULL),
(132, 1, '2021-09-12 04:30:00', '2021-09-12 05:00:00', NULL, NULL, 0, NULL),
(133, 1, '2021-09-12 05:00:00', '2021-09-12 05:30:00', NULL, NULL, 0, NULL),
(134, 1, '2021-09-12 05:30:00', '2021-09-12 06:00:00', NULL, NULL, 0, NULL),
(135, 1, '2021-09-13 00:00:00', '2021-09-13 00:30:00', NULL, NULL, 0, NULL),
(136, 1, '2021-09-13 00:30:00', '2021-09-13 01:00:00', NULL, NULL, 0, NULL),
(137, 1, '2021-09-13 01:00:00', '2021-09-13 01:30:00', NULL, NULL, 0, NULL),
(138, 1, '2021-09-13 01:30:00', '2021-09-13 02:00:00', NULL, NULL, 0, NULL),
(139, 1, '2021-09-13 02:00:00', '2021-09-13 02:30:00', NULL, NULL, 0, NULL),
(140, 1, '2021-09-13 02:30:00', '2021-09-13 03:00:00', NULL, NULL, 0, NULL),
(141, 1, '2021-09-13 03:00:00', '2021-09-13 03:30:00', NULL, NULL, 0, NULL),
(142, 1, '2021-09-13 03:30:00', '2021-09-13 04:00:00', NULL, NULL, 0, NULL),
(143, 1, '2021-09-13 04:00:00', '2021-09-13 04:30:00', NULL, NULL, 0, NULL),
(144, 1, '2021-09-13 04:30:00', '2021-09-13 05:00:00', NULL, NULL, 0, NULL),
(145, 1, '2021-09-13 05:00:00', '2021-09-13 05:30:00', NULL, NULL, 0, NULL),
(146, 1, '2021-09-13 05:30:00', '2021-09-13 06:00:00', NULL, NULL, 0, NULL),
(147, 1, '2021-09-14 00:00:00', '2021-09-14 00:30:00', NULL, NULL, 0, NULL),
(148, 1, '2021-09-14 00:30:00', '2021-09-14 01:00:00', NULL, NULL, 0, NULL),
(149, 1, '2021-09-14 01:00:00', '2021-09-14 01:30:00', NULL, NULL, 0, NULL),
(150, 1, '2021-09-14 01:30:00', '2021-09-14 02:00:00', NULL, NULL, 0, NULL),
(151, 1, '2021-09-14 02:00:00', '2021-09-14 02:30:00', NULL, NULL, 0, NULL),
(152, 1, '2021-09-14 02:30:00', '2021-09-14 03:00:00', NULL, NULL, 0, NULL),
(153, 1, '2021-09-14 03:00:00', '2021-09-14 03:30:00', NULL, NULL, 0, NULL),
(154, 1, '2021-09-14 03:30:00', '2021-09-14 04:00:00', NULL, NULL, 0, NULL),
(155, 1, '2021-09-14 04:00:00', '2021-09-14 04:30:00', NULL, NULL, 0, NULL),
(156, 1, '2021-09-14 04:30:00', '2021-09-14 05:00:00', NULL, NULL, 0, NULL),
(157, 1, '2021-09-14 05:00:00', '2021-09-14 05:30:00', NULL, NULL, 0, NULL),
(158, 1, '2021-09-14 05:30:00', '2021-09-14 06:00:00', NULL, NULL, 0, NULL),
(159, 1, '2021-09-15 00:00:00', '2021-09-15 00:30:00', NULL, NULL, 0, NULL),
(160, 1, '2021-09-15 00:30:00', '2021-09-15 01:00:00', NULL, NULL, 0, NULL),
(161, 1, '2021-09-15 01:00:00', '2021-09-15 01:30:00', NULL, NULL, 0, NULL),
(162, 1, '2021-09-15 01:30:00', '2021-09-15 02:00:00', NULL, NULL, 0, NULL),
(163, 1, '2021-09-15 02:00:00', '2021-09-15 02:30:00', NULL, NULL, 0, NULL),
(164, 1, '2021-09-15 02:30:00', '2021-09-15 03:00:00', NULL, NULL, 0, NULL),
(165, 1, '2021-09-15 03:00:00', '2021-09-15 03:30:00', NULL, NULL, 0, NULL),
(166, 1, '2021-09-15 03:30:00', '2021-09-15 04:00:00', NULL, NULL, 0, NULL),
(167, 1, '2021-09-15 04:00:00', '2021-09-15 04:30:00', NULL, NULL, 0, NULL),
(168, 1, '2021-09-15 04:30:00', '2021-09-15 05:00:00', NULL, NULL, 0, NULL),
(169, 1, '2021-09-15 05:00:00', '2021-09-15 05:30:00', NULL, NULL, 0, NULL),
(170, 1, '2021-09-15 05:30:00', '2021-09-15 06:00:00', NULL, NULL, 0, NULL),
(171, 1, '2021-09-16 00:00:00', '2021-09-16 00:30:00', NULL, NULL, 0, NULL),
(172, 1, '2021-09-16 00:30:00', '2021-09-16 01:00:00', NULL, NULL, 0, NULL),
(173, 1, '2021-09-16 01:00:00', '2021-09-16 01:30:00', NULL, NULL, 0, NULL),
(174, 1, '2021-09-16 01:30:00', '2021-09-16 02:00:00', NULL, NULL, 0, NULL),
(175, 1, '2021-09-16 02:00:00', '2021-09-16 02:30:00', NULL, NULL, 0, NULL),
(176, 1, '2021-09-16 02:30:00', '2021-09-16 03:00:00', NULL, NULL, 0, NULL),
(177, 1, '2021-09-16 03:00:00', '2021-09-16 03:30:00', NULL, NULL, 0, NULL),
(178, 1, '2021-09-16 03:30:00', '2021-09-16 04:00:00', NULL, NULL, 0, NULL),
(179, 1, '2021-09-16 04:00:00', '2021-09-16 04:30:00', NULL, NULL, 0, NULL),
(180, 1, '2021-09-16 04:30:00', '2021-09-16 05:00:00', NULL, NULL, 0, NULL),
(181, 1, '2021-09-16 05:00:00', '2021-09-16 05:30:00', NULL, NULL, 0, NULL),
(182, 1, '2021-09-16 05:30:00', '2021-09-16 06:00:00', NULL, NULL, 0, NULL),
(183, 1, '2021-09-17 00:00:00', '2021-09-17 00:30:00', NULL, NULL, 0, NULL),
(184, 1, '2021-09-17 00:30:00', '2021-09-17 01:00:00', NULL, NULL, 0, NULL),
(185, 1, '2021-09-17 01:00:00', '2021-09-17 01:30:00', NULL, NULL, 0, NULL),
(186, 1, '2021-09-17 01:30:00', '2021-09-17 02:00:00', NULL, NULL, 0, NULL),
(187, 1, '2021-09-17 02:00:00', '2021-09-17 02:30:00', NULL, NULL, 0, NULL),
(188, 1, '2021-09-17 02:30:00', '2021-09-17 03:00:00', NULL, NULL, 0, NULL),
(189, 1, '2021-09-17 03:00:00', '2021-09-17 03:30:00', NULL, NULL, 0, NULL),
(190, 1, '2021-09-17 03:30:00', '2021-09-17 04:00:00', NULL, NULL, 0, NULL),
(191, 1, '2021-09-17 04:00:00', '2021-09-17 04:30:00', NULL, NULL, 0, NULL),
(192, 1, '2021-09-17 04:30:00', '2021-09-17 05:00:00', NULL, NULL, 0, NULL),
(193, 1, '2021-09-17 05:00:00', '2021-09-17 05:30:00', NULL, NULL, 0, NULL),
(194, 1, '2021-09-17 05:30:00', '2021-09-17 06:00:00', NULL, NULL, 0, NULL),
(195, 2, '2021-09-12 00:00:00', '2021-09-12 00:30:00', NULL, NULL, 0, NULL),
(196, 2, '2021-09-12 00:30:00', '2021-09-12 01:00:00', NULL, NULL, 0, NULL),
(197, 2, '2021-09-12 01:00:00', '2021-09-12 01:30:00', NULL, NULL, 0, NULL),
(198, 2, '2021-09-12 01:30:00', '2021-09-12 02:00:00', NULL, NULL, 0, NULL),
(199, 2, '2021-09-12 02:00:00', '2021-09-12 02:30:00', NULL, NULL, 0, NULL),
(200, 2, '2021-09-12 02:30:00', '2021-09-12 03:00:00', NULL, NULL, 0, NULL),
(201, 2, '2021-09-12 03:00:00', '2021-09-12 03:30:00', NULL, NULL, 0, NULL),
(202, 2, '2021-09-12 03:30:00', '2021-09-12 04:00:00', NULL, NULL, 0, NULL),
(203, 2, '2021-09-12 04:00:00', '2021-09-12 04:30:00', NULL, NULL, 0, NULL),
(204, 2, '2021-09-12 04:30:00', '2021-09-12 05:00:00', NULL, NULL, 0, NULL),
(205, 2, '2021-09-12 05:00:00', '2021-09-12 05:30:00', NULL, NULL, 0, NULL),
(206, 2, '2021-09-12 05:30:00', '2021-09-12 06:00:00', NULL, NULL, 0, NULL),
(207, 2, '2021-09-13 00:00:00', '2021-09-13 00:30:00', NULL, NULL, 0, NULL),
(208, 2, '2021-09-13 00:30:00', '2021-09-13 01:00:00', NULL, NULL, 0, NULL),
(209, 2, '2021-09-13 01:00:00', '2021-09-13 01:30:00', NULL, NULL, 0, NULL),
(210, 2, '2021-09-13 01:30:00', '2021-09-13 02:00:00', NULL, NULL, 0, NULL),
(211, 2, '2021-09-13 02:00:00', '2021-09-13 02:30:00', NULL, NULL, 0, NULL),
(212, 2, '2021-09-13 02:30:00', '2021-09-13 03:00:00', NULL, NULL, 0, NULL),
(213, 2, '2021-09-13 03:00:00', '2021-09-13 03:30:00', NULL, NULL, 0, NULL),
(214, 2, '2021-09-13 03:30:00', '2021-09-13 04:00:00', NULL, NULL, 0, NULL),
(215, 2, '2021-09-13 04:00:00', '2021-09-13 04:30:00', NULL, NULL, 0, NULL),
(216, 2, '2021-09-13 04:30:00', '2021-09-13 05:00:00', NULL, NULL, 0, NULL),
(217, 2, '2021-09-13 05:00:00', '2021-09-13 05:30:00', NULL, NULL, 0, NULL),
(218, 2, '2021-09-13 05:30:00', '2021-09-13 06:00:00', NULL, NULL, 0, NULL),
(219, 2, '2021-09-14 00:00:00', '2021-09-14 00:30:00', NULL, NULL, 0, NULL),
(220, 2, '2021-09-14 00:30:00', '2021-09-14 01:00:00', NULL, NULL, 0, NULL),
(221, 2, '2021-09-14 01:00:00', '2021-09-14 01:30:00', NULL, NULL, 0, NULL),
(222, 2, '2021-09-14 01:30:00', '2021-09-14 02:00:00', NULL, NULL, 0, NULL),
(223, 2, '2021-09-14 02:00:00', '2021-09-14 02:30:00', NULL, NULL, 0, NULL),
(224, 2, '2021-09-14 02:30:00', '2021-09-14 03:00:00', NULL, NULL, 0, NULL),
(225, 2, '2021-09-14 03:00:00', '2021-09-14 03:30:00', NULL, NULL, 0, NULL),
(226, 2, '2021-09-14 03:30:00', '2021-09-14 04:00:00', NULL, NULL, 0, NULL),
(227, 2, '2021-09-14 04:00:00', '2021-09-14 04:30:00', NULL, NULL, 0, NULL),
(228, 2, '2021-09-14 04:30:00', '2021-09-14 05:00:00', NULL, NULL, 0, NULL),
(229, 2, '2021-09-14 05:00:00', '2021-09-14 05:30:00', NULL, NULL, 0, NULL),
(230, 2, '2021-09-14 05:30:00', '2021-09-14 06:00:00', NULL, NULL, 0, NULL),
(231, 2, '2021-09-15 00:00:00', '2021-09-15 00:30:00', NULL, NULL, 0, NULL),
(232, 2, '2021-09-15 00:30:00', '2021-09-15 01:00:00', NULL, NULL, 0, NULL),
(233, 2, '2021-09-15 01:00:00', '2021-09-15 01:30:00', NULL, NULL, 0, NULL),
(234, 2, '2021-09-15 01:30:00', '2021-09-15 02:00:00', NULL, NULL, 0, NULL),
(235, 2, '2021-09-15 02:00:00', '2021-09-15 02:30:00', NULL, NULL, 0, NULL),
(236, 2, '2021-09-15 02:30:00', '2021-09-15 03:00:00', NULL, NULL, 0, NULL),
(237, 2, '2021-09-15 03:00:00', '2021-09-15 03:30:00', NULL, NULL, 0, NULL),
(238, 2, '2021-09-15 03:30:00', '2021-09-15 04:00:00', NULL, NULL, 0, NULL),
(239, 2, '2021-09-15 04:00:00', '2021-09-15 04:30:00', NULL, NULL, 0, NULL),
(240, 2, '2021-09-15 04:30:00', '2021-09-15 05:00:00', NULL, NULL, 0, NULL),
(241, 2, '2021-09-15 05:00:00', '2021-09-15 05:30:00', NULL, NULL, 0, NULL),
(242, 2, '2021-09-15 05:30:00', '2021-09-15 06:00:00', NULL, NULL, 0, NULL),
(243, 2, '2021-09-16 00:00:00', '2021-09-16 00:30:00', NULL, NULL, 0, NULL),
(244, 2, '2021-09-16 00:30:00', '2021-09-16 01:00:00', NULL, NULL, 0, NULL),
(245, 2, '2021-09-16 01:00:00', '2021-09-16 01:30:00', NULL, NULL, 0, NULL),
(246, 2, '2021-09-16 01:30:00', '2021-09-16 02:00:00', NULL, NULL, 0, NULL),
(247, 2, '2021-09-16 02:00:00', '2021-09-16 02:30:00', NULL, NULL, 0, NULL),
(248, 2, '2021-09-16 02:30:00', '2021-09-16 03:00:00', NULL, NULL, 0, NULL),
(249, 2, '2021-09-16 03:00:00', '2021-09-16 03:30:00', NULL, NULL, 0, NULL),
(250, 2, '2021-09-16 03:30:00', '2021-09-16 04:00:00', NULL, NULL, 0, NULL),
(251, 2, '2021-09-16 04:00:00', '2021-09-16 04:30:00', NULL, NULL, 0, NULL),
(252, 2, '2021-09-16 04:30:00', '2021-09-16 05:00:00', NULL, NULL, 0, NULL),
(253, 2, '2021-09-16 05:00:00', '2021-09-16 05:30:00', NULL, NULL, 0, NULL),
(254, 2, '2021-09-16 05:30:00', '2021-09-16 06:00:00', NULL, NULL, 0, NULL),
(255, 2, '2021-09-17 00:00:00', '2021-09-17 00:30:00', NULL, NULL, 0, NULL),
(256, 2, '2021-09-17 00:30:00', '2021-09-17 01:00:00', NULL, NULL, 0, NULL),
(257, 2, '2021-09-17 01:00:00', '2021-09-17 01:30:00', NULL, NULL, 0, NULL),
(258, 2, '2021-09-17 01:30:00', '2021-09-17 02:00:00', NULL, NULL, 0, NULL),
(259, 2, '2021-09-17 02:00:00', '2021-09-17 02:30:00', NULL, NULL, 0, NULL),
(260, 2, '2021-09-17 02:30:00', '2021-09-17 03:00:00', NULL, NULL, 0, NULL),
(261, 2, '2021-09-17 03:00:00', '2021-09-17 03:30:00', NULL, NULL, 0, NULL),
(262, 2, '2021-09-17 03:30:00', '2021-09-17 04:00:00', NULL, NULL, 0, NULL),
(263, 2, '2021-09-17 04:00:00', '2021-09-17 04:30:00', NULL, NULL, 0, NULL),
(264, 2, '2021-09-17 04:30:00', '2021-09-17 05:00:00', NULL, NULL, 0, NULL),
(265, 2, '2021-09-17 05:00:00', '2021-09-17 05:30:00', NULL, NULL, 0, NULL),
(266, 2, '2021-09-17 05:30:00', '2021-09-17 06:00:00', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_badges`
--

CREATE TABLE `teacher_badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `badge_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_banks`
--

CREATE TABLE `teacher_banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acct_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_followers`
--

CREATE TABLE `teacher_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `followed_teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_lesson_history`
--

CREATE TABLE `teacher_lesson_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `is_refund` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = not refund, 1 = refund',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_newsfeed`
--

CREATE TABLE `teacher_newsfeed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `feed_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `feed_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_newsfeed`
--

INSERT INTO `teacher_newsfeed` (`id`, `teacher_id`, `feed_title`, `feed_body`, `created_at`, `updated_at`) VALUES
(1, 7, '', 'Test 1234', '2021-07-18 04:52:11', '2021-07-18 04:52:11'),
(2, 7, '', 'Test 12345', '2021-07-18 05:18:09', '2021-07-18 05:18:09'),
(3, 7, '', 'Test 123456', '2021-07-18 05:21:19', '2021-07-18 05:21:19'),
(4, 7, '', 'Test Post 1234567', '2021-07-18 05:25:19', '2021-07-18 05:25:19'),
(5, 7, '', 'Test Post 1', '2021-07-18 09:46:32', '2021-07-18 09:46:32'),
(6, 7, '', 'This is a test post', '2021-07-18 09:52:12', '2021-07-18 09:52:12'),
(7, 7, '', 'This is a test post again', '2021-07-18 09:53:18', '2021-07-18 09:53:18'),
(8, 7, '', 'TEST POSTING 2021-07-18', '2021-07-18 11:53:06', '2021-07-18 11:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_newsfeed_attachments`
--

CREATE TABLE `teacher_newsfeed_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_newsfeed_id` bigint(20) UNSIGNED NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_newsfeed_attachments`
--

INSERT INTO `teacher_newsfeed_attachments` (`id`, `teacher_newsfeed_id`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, 'fernando-jr.png', '2021-07-18 05:18:09', '2021-07-18 05:18:09'),
(2, 2, 'pic_white_bg.jpg', '2021-07-18 05:18:09', '2021-07-18 05:18:09'),
(3, 3, 'Techturf-Independence-Day.jpg', '2021-07-18 05:21:20', '2021-07-18 05:21:20'),
(4, 3, 'Techturf-Independence-Day.png', '2021-07-18 05:21:20', '2021-07-18 05:21:20'),
(5, 4, 'VNICP_SPONSORS.png', '2021-07-18 05:25:20', '2021-07-18 05:25:20'),
(6, 4, 'VNICP-MOCK.png', '2021-07-18 05:25:20', '2021-07-18 05:25:20'),
(7, 5, 'VNICP.png', '2021-07-18 09:46:32', '2021-07-18 09:46:32'),
(8, 5, 'VNICP_AGENDA.png', '2021-07-18 09:46:32', '2021-07-18 09:46:32'),
(9, 5, 'VNICP_REGISTRATION.png', '2021-07-18 09:46:32', '2021-07-18 09:46:32'),
(10, 6, 'VNICP_HOME.png', '2021-07-18 09:52:13', '2021-07-18 09:52:13'),
(11, 6, 'VNICP_AGENDA.png', '2021-07-18 09:52:13', '2021-07-18 09:52:13'),
(12, 6, 'VNICP_BSESSIONS.png', '2021-07-18 09:52:13', '2021-07-18 09:52:13'),
(13, 7, 'VNICP_REGISTRATION.png', '2021-07-18 09:53:18', '2021-07-18 09:53:18'),
(14, 7, 'VNICP_SPONSORS.png', '2021-07-18 09:53:18', '2021-07-18 09:53:18'),
(15, 8, 'VNICP_AGENDA.png', '2021-07-18 11:53:06', '2021-07-18 11:53:06'),
(16, 8, 'VNICP_BSESSIONS.png', '2021-07-18 11:53:06', '2021-07-18 11:53:06'),
(17, 8, 'VNICP_HOME.png', '2021-07-18 11:53:07', '2021-07-18 11:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_newsfeed_comments`
--

CREATE TABLE `teacher_newsfeed_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_newsfeed_id` bigint(20) UNSIGNED NOT NULL,
  `teachers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `students_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_newsfeed_likes`
--

CREATE TABLE `teacher_newsfeed_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_newsfeed_id` bigint(20) UNSIGNED NOT NULL,
  `teachers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `students_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_like` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 => disliked, 1 => liked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_uploads`
--

CREATE TABLE `teacher_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `upload_types_id` bigint(20) UNSIGNED NOT NULL,
  `files` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_lesson`
--

CREATE TABLE `type_of_lesson` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_of_lesson`
--

INSERT INTO `type_of_lesson` (`id`, `lesson_type`, `created_at`, `updated_at`) VALUES
(1, 'YOUNG LEARNERS', '2021-05-31 16:00:00', NULL),
(2, 'ADULTS', '2021-05-31 16:00:00', NULL),
(3, 'TEST PREPARATION', '2021-05-31 16:00:00', NULL),
(4, 'SPECIFIC', '2021-05-31 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upload_types`
--

CREATE TABLE `upload_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badge_request`
--
ALTER TABLE `badge_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `badge_request_teacher_id_foreign` (`teacher_id`),
  ADD KEY `badge_request_teacher_uploads_id_foreign` (`teacher_uploads_id`),
  ADD KEY `badge_request_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `communication_app`
--
ALTER TABLE `communication_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_rate`
--
ALTER TABLE `currency_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `heygo_wallet`
--
ALTER TABLE `heygo_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `heygo_wallet_students_payment_log_id_foreign` (`students_payment_log_id`);

--
-- Indexes for table `language_level`
--
ALTER TABLE `language_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_option`
--
ALTER TABLE `lesson_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_option_currency_rate_id_foreign` (`currency_rate_id`);

--
-- Indexes for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_plan_type_of_lesson_id_foreign` (`type_of_lesson_id`);

--
-- Indexes for table `lesson_plan_attachments`
--
ALTER TABLE `lesson_plan_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_plan_attachments_lesson_plan_id_foreign` (`lesson_plan_id`);

--
-- Indexes for table `lesson_plan_comments`
--
ALTER TABLE `lesson_plan_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_plan_comments_lesson_plan_id_foreign` (`lesson_plan_id`),
  ADD KEY `lesson_plan_comments_teachers_id_foreign` (`teachers_id`);

--
-- Indexes for table `lesson_plan_questionare`
--
ALTER TABLE `lesson_plan_questionare`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_plan_questionare_lesson_plan_id_foreign` (`lesson_plan_id`),
  ADD KEY `lesson_plan_questionare_students_id_foreign` (`students_id`);

--
-- Indexes for table `lesson_plan_ratings`
--
ALTER TABLE `lesson_plan_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_plan_ratings_lesson_plan_id_foreign` (`lesson_plan_id`),
  ADD KEY `lesson_plan_ratings_rated_teachers_id_foreign` (`rated_teachers_id`);

--
-- Indexes for table `lesson_rate_type`
--
ALTER TABLE `lesson_rate_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_schedule`
--
ALTER TABLE `lesson_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_schedule_lesson_plan_id_foreign` (`lesson_plan_id`),
  ADD KEY `lesson_schedule_students_id_foreign` (`students_id`),
  ADD KEY `lesson_schedule_lesson_option_id_foreign` (`lesson_option_id`),
  ADD KEY `lesson_schedule_teachers_id_foreign` (`teachers_id`),
  ADD KEY `lesson_schedule_communication_app_id_foreign` (`communication_app_id`);

--
-- Indexes for table `lesson_schedule_details`
--
ALTER TABLE `lesson_schedule_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_schedule_details_lesson_schedule_id_foreign` (`lesson_schedule_id`);

--
-- Indexes for table `lesson_type_details`
--
ALTER TABLE `lesson_type_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_teachers_id_foreign` (`teachers_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_country_id_foreign` (`country_id`);

--
-- Indexes for table `students_date_plan`
--
ALTER TABLE `students_date_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_english_level`
--
ALTER TABLE `students_english_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_level`
--
ALTER TABLE `students_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_payment_log`
--
ALTER TABLE `students_payment_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_payment_log_lesson_schedule_id_foreign` (`lesson_schedule_id`);

--
-- Indexes for table `students_pref`
--
ALTER TABLE `students_pref`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_pref_students_id_foreign` (`students_id`),
  ADD KEY `students_pref_students_level_id_foreign` (`students_level_id`),
  ADD KEY `students_pref_students_test_preparation_id_foreign` (`students_test_preparation_id`),
  ADD KEY `students_pref_students_date_plan_id_foreign` (`students_date_plan_id`),
  ADD KEY `students_pref_teachers_id_foreign` (`teachers_id`),
  ADD KEY `students_pref_lesson_schedule_id_foreign` (`lesson_schedule_id`),
  ADD KEY `students_pref_lesson_option_id_foreign` (`lesson_option_id`);

--
-- Indexes for table `students_test_preparation`
--
ALTER TABLE `students_test_preparation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_banks`
--
ALTER TABLE `student_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_banks_student_id_foreign` (`student_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_country_id_foreign` (`country_id`),
  ADD KEY `teachers_lesson_rate_type_id_foreign` (`lesson_rate_type_id`),
  ADD KEY `teachers_lesson_plan_id_foreign` (`lesson_plan_id`),
  ADD KEY `teachers_currency_rate_id_foreign` (`currency_rate_id`);

--
-- Indexes for table `teachers_wallet`
--
ALTER TABLE `teachers_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_wallet_students_payment_log_id_foreign` (`students_payment_log_id`);

--
-- Indexes for table `teacher_availability`
--
ALTER TABLE `teacher_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_availability_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_availability_lesson_plan_id_foreign` (`lesson_plan_id`);

--
-- Indexes for table `teacher_badges`
--
ALTER TABLE `teacher_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_badges_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_badges_badge_id_foreign` (`badge_id`);

--
-- Indexes for table `teacher_banks`
--
ALTER TABLE `teacher_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_banks_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `teacher_followers`
--
ALTER TABLE `teacher_followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_followers_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_followers_followed_teacher_id_foreign` (`followed_teacher_id`);

--
-- Indexes for table `teacher_lesson_history`
--
ALTER TABLE `teacher_lesson_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_lesson_history_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `teacher_newsfeed`
--
ALTER TABLE `teacher_newsfeed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_newsfeed_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `teacher_newsfeed_attachments`
--
ALTER TABLE `teacher_newsfeed_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_newsfeed_attachments_teacher_newsfeed_id_foreign` (`teacher_newsfeed_id`);

--
-- Indexes for table `teacher_newsfeed_comments`
--
ALTER TABLE `teacher_newsfeed_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_newsfeed_comments_teacher_newsfeed_id_foreign` (`teacher_newsfeed_id`),
  ADD KEY `teacher_newsfeed_comments_teachers_id_foreign` (`teachers_id`),
  ADD KEY `teacher_newsfeed_comments_students_id_foreign` (`students_id`);

--
-- Indexes for table `teacher_newsfeed_likes`
--
ALTER TABLE `teacher_newsfeed_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_newsfeed_likes_teacher_newsfeed_id_foreign` (`teacher_newsfeed_id`),
  ADD KEY `teacher_newsfeed_likes_teachers_id_foreign` (`teachers_id`),
  ADD KEY `teacher_newsfeed_likes_students_id_foreign` (`students_id`);

--
-- Indexes for table `teacher_uploads`
--
ALTER TABLE `teacher_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_uploads_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_uploads_upload_types_id_foreign` (`upload_types_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_lesson`
--
ALTER TABLE `type_of_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_types`
--
ALTER TABLE `upload_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_type_id_foreign` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badge_request`
--
ALTER TABLE `badge_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `communication_app`
--
ALTER TABLE `communication_app`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `currency_rate`
--
ALTER TABLE `currency_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heygo_wallet`
--
ALTER TABLE `heygo_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `language_level`
--
ALTER TABLE `language_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_option`
--
ALTER TABLE `lesson_option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `lesson_plan_attachments`
--
ALTER TABLE `lesson_plan_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_plan_comments`
--
ALTER TABLE `lesson_plan_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_plan_questionare`
--
ALTER TABLE `lesson_plan_questionare`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_plan_ratings`
--
ALTER TABLE `lesson_plan_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_rate_type`
--
ALTER TABLE `lesson_rate_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lesson_schedule`
--
ALTER TABLE `lesson_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `lesson_schedule_details`
--
ALTER TABLE `lesson_schedule_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `lesson_type_details`
--
ALTER TABLE `lesson_type_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `students_date_plan`
--
ALTER TABLE `students_date_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_english_level`
--
ALTER TABLE `students_english_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students_level`
--
ALTER TABLE `students_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students_payment_log`
--
ALTER TABLE `students_payment_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `students_pref`
--
ALTER TABLE `students_pref`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `students_test_preparation`
--
ALTER TABLE `students_test_preparation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_banks`
--
ALTER TABLE `student_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers_wallet`
--
ALTER TABLE `teachers_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teacher_availability`
--
ALTER TABLE `teacher_availability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `teacher_badges`
--
ALTER TABLE `teacher_badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_banks`
--
ALTER TABLE `teacher_banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_followers`
--
ALTER TABLE `teacher_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_lesson_history`
--
ALTER TABLE `teacher_lesson_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_newsfeed`
--
ALTER TABLE `teacher_newsfeed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher_newsfeed_attachments`
--
ALTER TABLE `teacher_newsfeed_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teacher_newsfeed_comments`
--
ALTER TABLE `teacher_newsfeed_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_newsfeed_likes`
--
ALTER TABLE `teacher_newsfeed_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_uploads`
--
ALTER TABLE `teacher_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_lesson`
--
ALTER TABLE `type_of_lesson`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upload_types`
--
ALTER TABLE `upload_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badge_request`
--
ALTER TABLE `badge_request`
  ADD CONSTRAINT `badge_request_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `badge_request_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `badge_request_teacher_uploads_id_foreign` FOREIGN KEY (`teacher_uploads_id`) REFERENCES `teacher_uploads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `heygo_wallet`
--
ALTER TABLE `heygo_wallet`
  ADD CONSTRAINT `heygo_wallet_students_payment_log_id_foreign` FOREIGN KEY (`students_payment_log_id`) REFERENCES `students_payment_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_option`
--
ALTER TABLE `lesson_option`
  ADD CONSTRAINT `lesson_option_currency_rate_id_foreign` FOREIGN KEY (`currency_rate_id`) REFERENCES `currency_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_plan`
--
ALTER TABLE `lesson_plan`
  ADD CONSTRAINT `lesson_plan_type_of_lesson_id_foreign` FOREIGN KEY (`type_of_lesson_id`) REFERENCES `type_of_lesson` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_plan_attachments`
--
ALTER TABLE `lesson_plan_attachments`
  ADD CONSTRAINT `lesson_plan_attachments_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_plan_comments`
--
ALTER TABLE `lesson_plan_comments`
  ADD CONSTRAINT `lesson_plan_comments_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_plan_comments_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_plan_questionare`
--
ALTER TABLE `lesson_plan_questionare`
  ADD CONSTRAINT `lesson_plan_questionare_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_plan_questionare_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_plan_ratings`
--
ALTER TABLE `lesson_plan_ratings`
  ADD CONSTRAINT `lesson_plan_ratings_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_plan_ratings_rated_teachers_id_foreign` FOREIGN KEY (`rated_teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_schedule`
--
ALTER TABLE `lesson_schedule`
  ADD CONSTRAINT `lesson_schedule_communication_app_id_foreign` FOREIGN KEY (`communication_app_id`) REFERENCES `communication_app` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedule_lesson_option_id_foreign` FOREIGN KEY (`lesson_option_id`) REFERENCES `lesson_option` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedule_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_schedule_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_schedule_details`
--
ALTER TABLE `lesson_schedule_details`
  ADD CONSTRAINT `lesson_schedule_details_lesson_schedule_id_foreign` FOREIGN KEY (`lesson_schedule_id`) REFERENCES `lesson_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students_payment_log`
--
ALTER TABLE `students_payment_log`
  ADD CONSTRAINT `students_payment_log_lesson_schedule_id_foreign` FOREIGN KEY (`lesson_schedule_id`) REFERENCES `lesson_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students_pref`
--
ALTER TABLE `students_pref`
  ADD CONSTRAINT `students_pref_lesson_option_id_foreign` FOREIGN KEY (`lesson_option_id`) REFERENCES `lesson_option` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_lesson_schedule_id_foreign` FOREIGN KEY (`lesson_schedule_id`) REFERENCES `lesson_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_students_date_plan_id_foreign` FOREIGN KEY (`students_date_plan_id`) REFERENCES `students_date_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_students_level_id_foreign` FOREIGN KEY (`students_level_id`) REFERENCES `students_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_students_test_preparation_id_foreign` FOREIGN KEY (`students_test_preparation_id`) REFERENCES `students_test_preparation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_pref_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_banks`
--
ALTER TABLE `student_banks`
  ADD CONSTRAINT `student_banks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_currency_rate_id_foreign` FOREIGN KEY (`currency_rate_id`) REFERENCES `currency_rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teachers_lesson_rate_type_id_foreign` FOREIGN KEY (`lesson_rate_type_id`) REFERENCES `lesson_rate_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers_wallet`
--
ALTER TABLE `teachers_wallet`
  ADD CONSTRAINT `teachers_wallet_students_payment_log_id_foreign` FOREIGN KEY (`students_payment_log_id`) REFERENCES `students_payment_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_availability`
--
ALTER TABLE `teacher_availability`
  ADD CONSTRAINT `teacher_availability_lesson_plan_id_foreign` FOREIGN KEY (`lesson_plan_id`) REFERENCES `lesson_plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_availability_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_badges`
--
ALTER TABLE `teacher_badges`
  ADD CONSTRAINT `teacher_badges_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_badges_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_banks`
--
ALTER TABLE `teacher_banks`
  ADD CONSTRAINT `teacher_banks_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_followers`
--
ALTER TABLE `teacher_followers`
  ADD CONSTRAINT `teacher_followers_followed_teacher_id_foreign` FOREIGN KEY (`followed_teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_followers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_lesson_history`
--
ALTER TABLE `teacher_lesson_history`
  ADD CONSTRAINT `teacher_lesson_history_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_newsfeed`
--
ALTER TABLE `teacher_newsfeed`
  ADD CONSTRAINT `teacher_newsfeed_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_newsfeed_attachments`
--
ALTER TABLE `teacher_newsfeed_attachments`
  ADD CONSTRAINT `teacher_newsfeed_attachments_teacher_newsfeed_id_foreign` FOREIGN KEY (`teacher_newsfeed_id`) REFERENCES `teacher_newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_newsfeed_comments`
--
ALTER TABLE `teacher_newsfeed_comments`
  ADD CONSTRAINT `teacher_newsfeed_comments_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_newsfeed_comments_teacher_newsfeed_id_foreign` FOREIGN KEY (`teacher_newsfeed_id`) REFERENCES `teacher_newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_newsfeed_comments_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_newsfeed_likes`
--
ALTER TABLE `teacher_newsfeed_likes`
  ADD CONSTRAINT `teacher_newsfeed_likes_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_newsfeed_likes_teacher_newsfeed_id_foreign` FOREIGN KEY (`teacher_newsfeed_id`) REFERENCES `teacher_newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_newsfeed_likes_teachers_id_foreign` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_uploads`
--
ALTER TABLE `teacher_uploads`
  ADD CONSTRAINT `teacher_uploads_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_uploads_upload_types_id_foreign` FOREIGN KEY (`upload_types_id`) REFERENCES `upload_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
