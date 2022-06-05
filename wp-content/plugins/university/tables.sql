create table if not exists brans (
    brans_id int auto_increment primary key,
    brans_name text not null,
    brans_url text
) collate utf8mb4_general_ci;

create table if not exists fakulte (
    fakulte_id int auto_increment primary key,
    fakulte_name text not null,
    fakulte_url text
) collate utf8mb4_general_ci;

create table if not exists enistitu (
    enistitu_id int auto_increment primary key,
    enistitu_name text not null,
    enistitu_url text
) collate utf8mb4_general_ci;

create table if not exists universite (
    universite_id int auto_increment primary key,
    universite_name text not null,
    universite_logo text not null,
    universite_telefon text not null,
    universite_email text not null,
    universite_url text not null,
    universite_map text not null,
    universite_city text not null,
    universite_type text not null,
    universite_world_order int not null,
    universite_local_order int not null,
    universite_education_language text not null 
) collate utf8mb4_general_ci;


create table if not exists universite_fakulte (
    id int auto_increment primary key,
    universite_id int not null,
    fakulte_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (fakulte_id) references fakulte(fakulte_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;


create table if not exists universite_enistitu (
    id int auto_increment primary key,
    universite_id int not null,
    enistitu_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (enistitu_id) references enistitu(enistitu_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists fakulte_brans (
    id int auto_increment primary key,
    fakulte_id int not null,
    brans_id int not null,
    foreign key (fakulte_id) references fakulte(fakulte_id) ON DELETE CASCADE,
    foreign key (brans_id) references brans(brans_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists enistitu_brans (
    id int auto_increment primary key,
    enistitu_id int not null,
    brans_id int not null,
    foreign key (enistitu_id) references enistitu(enistitu_id) ON DELETE CASCADE,
    foreign key (brans_id) references brans(brans_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists universite_yos (
    id int auto_increment primary key,
    yos_id int not null,
    universite_id int not null,
    toggler int not null check (toggler IN (0,1)),
    foreign key (yos_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists lisans (
    id int auto_increment primary key,
    option_name text not null,
    option_value longtext,
    universite_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists yatay_gecis (
    id int auto_increment primary key,
    option_name text not null,
    option_value longtext,
    universite_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists master (
    id int auto_increment primary key,
    option_name text not null,
    option_value longtext,
    universite_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists yuksek_lisans (
    id int auto_increment primary key,
    option_name text not null,
    option_value longtext,
    universite_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists yos (
    id int auto_increment primary key,
    option_name text not null,
    option_value longtext,
    universite_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;


create table if not exists universite_fakulte_brans (
    id int auto_increment primary key,
    universite_id int not null,
    fakulte_id int not null,    
    brans_id int,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (fakulte_id) references fakulte(fakulte_id) ON DELETE CASCADE,
    foreign key (brans_id) references brans(brans_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists universite_enistitu_brans (
    id int auto_increment primary key,
    universite_id int not null,
    enistitu_id int not null,    
    brans_id int ,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (enistitu_id) references enistitu(enistitu_id) ON DELETE CASCADE,
    foreign key (brans_id) references brans(brans_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists slider (
    slider_id int auto_increment primary key,
    slider_image text not null,
    slider_title text not null,
    slider_description text not null
) collate utf8mb4_general_ci;

create table if not exists category (
    category_id int auto_increment primary key,
    category_name text not null
) collate utf8mb4_general_ci;

create table if not exists universite_category (
    id int auto_increment primary key,
    universite_id int not null,
    category_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (category_id ) references category(category_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists exam (
    exam_id int auto_increment primary key,
    exam_name text not null,
   exam_description longtext
) collate utf8mb4_general_ci;

create table if not exists universite_exam (
    id int auto_increment primary key,
    universite_id int not null,
    exam_id int not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE,
    foreign key (exam_id ) references exam(exam_id) ON DELETE CASCADE
) collate utf8mb4_general_ci;

create table if not exists contact (
    id int auto_increment primary key,
    fields longtext not null
) collate utf8mb4_general_ci;

create table if not exists fakulte_brans_url (
    id int auto_increment primary key,
    relation_id int not null,
    brans_url text  not null,
    foreign key (relation_id) references universite_fakulte_brans(id) ON DELETE CASCADE  
) collate utf8mb4_general_ci;

create table if not exists enistitu_brans_url (
    id int auto_increment primary key,
    relation_id int not null,
    brans_url text  not null,
    foreign key (relation_id) references universite_enistitu_brans(id) ON DELETE CASCADE  
) collate utf8mb4_general_ci;

create table if not exists universite_calendar (
    id int auto_increment primary key,
    universite_id int not null,
    basvuru text ,
    basvuru_baslangic date ,
    basvuru_bitis date ,
    basvuru_sonuc date ,
    basvuru_url text ,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE  
) collate utf8mb4_general_ci;

create table if not exists universite_fakulte_url (
    id int auto_increment primary key,
    universite_id int not null,
    fakulte_id int  not null,
    fakulte_url text not null,
    foreign key (universite_id) references universite(universite_id) ON DELETE CASCADE  ,
    foreign key (fakulte_id) references fakulte(fakulte_id) ON DELETE CASCADE  
) collate utf8mb4_general_ci;

create table if not exists universite_enistitu_url (
    id int auto_increment primary key,
    universite_id int not null,
    enistitu_id int  not null,
    enistitu_url text not null,
    foreign key (universite_id) references universite (universite_id) ON DELETE CASCADE  ,
    foreign key (enistitu_id) references enistitu (enistitu_id) ON DELETE CASCADE  
) collate utf8mb4_general_ci;

create table if not exists blog(
    blog_id int auto_increment primary key,
    blog_title text,
    blog_image text,
    blog_content text,
    blog_date date
) collate utf8mb4_general_ci;