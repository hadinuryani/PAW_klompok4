/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/9/2025 12:51:26 PM                        */
/*==============================================================*/



drop table if exists ADMINISTRATOR;



drop table if exists BUKU;



drop table if exists PEMINJAMAN;

drop table if exists PEMUSTAKA;

/*==============================================================*/
/* Table: ADMINISTRATOR                                         */
/*==============================================================*/
create table ADMINISTRATOR
(
   ID_ADMINISTRATOR     int not null  comment '',
   USERNAME_ADMIN       char(255)  comment '',
   PASSWORD_ADMINISTRATOR char(255)  comment '',
   primary key (ID_ADMINISTRATOR)
);

/*==============================================================*/
/* Table: BUKU                                                  */
/*==============================================================*/
create table BUKU
(
   ID_BUKU              int not null  comment '',
   ID_ADMINISTRATOR     int  comment '',
   JUDUL                char(255)  comment '',
   PENERBIT             char(255)  comment '',
   TAHUN_TERBIT         date  comment '',
   PENULIS              char(255)  comment '',
   COVER                longblob  comment '',
   KATEGORI             char(255)  comment '',
   primary key (ID_BUKU)
);

/*==============================================================*/
/* Table: PEMINJAMAN                                            */
/*==============================================================*/
create table PEMINJAMAN
(
   ID_PEMINJAMAN        int not null  comment '',
   ID_BUKU              int  comment '',
   ID_PEMUSTAKA         int  comment '',
   ID_ADMINISTRATOR     int  comment '',
   TANGGAL_PEMINJAMAN   date  comment '',
   primary key (ID_PEMINJAMAN)
);

/*==============================================================*/
/* Table: PEMUSTAKA                                             */
/*==============================================================*/
create table PEMUSTAKA
(
   ID_PEMUSTAKA         int not null  comment '',
   NAMA_PEMUSTAKA       char(255)  comment '',
   NIM_NIP              char(255)  comment '',
   PASSWORD_PEMUSTAKA   char(255)  comment '',
   primary key (ID_PEMUSTAKA)
);

alter table BUKU add constraint FK_BUKU_RELATIONS_ADMINIST foreign key (ID_ADMINISTRATOR)
      references ADMINISTRATOR (ID_ADMINISTRATOR) on delete restrict on update restrict;

alter table PEMINJAMAN add constraint FK_PEMINJAM_RELATIONS_PEMUSTAK foreign key (ID_PEMUSTAKA)
      references PEMUSTAKA (ID_PEMUSTAKA) on delete restrict on update restrict;

alter table PEMINJAMAN add constraint FK_PEMINJAM_RELATIONS_BUKU foreign key (ID_BUKU)
      references BUKU (ID_BUKU) on delete restrict on update restrict;

alter table PEMINJAMAN add constraint FK_PEMINJAM_RELATIONS_ADMINIST foreign key (ID_ADMINISTRATOR)
      references ADMINISTRATOR (ID_ADMINISTRATOR) on delete restrict on update restrict;

