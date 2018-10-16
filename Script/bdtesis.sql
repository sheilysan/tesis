create TABLE tipo_persona (
id_tipo int AUTO_INCREMENT not null,
nombre varchar (8) not null,
CONSTRAINT pk_tipo_persona PRIMARY key (id_tipo)
);

create TABLE periodo (
id_periodo int AUTO_INCREMENT not null,
nombre varchar (50) not null,
fecha_inicio date not null,
fecha_fin date not null,
CONSTRAINT pk_id_periodo PRIMARY key (id_periodo)
);

create TABLE hueso (
id_hueso int AUTO_INCREMENT not null,
informacion text not null,
modelo text not null,
CONSTRAINT pk_id_hueso PRIMARY key (id_hueso)
);

create TABLE tipo_test (
id_tipo_test int AUTO_INCREMENT not null,
nombre varchar (6) not null,
CONSTRAINT pk_tipo_test PRIMARY key (id_tipo_test)
);

create TABLE persona (
id_persona int AUTO_INCREMENT not null,
paterno varchar (50) not null,
materno varchar (50) not null,
nombres varchar (30) not null,
sexo char (1) null,
fecha_nacimiento date null,
telefono varchar (11) null,
id_tipo_persona int not null,
CONSTRAINT pk_persona PRIMARY key (id_persona),
CONSTRAINT fk_persona_tipo_persona foreign key (id_tipo_persona) references tipo_persona(id_tipo)
);

create TABLE usuario (
id_usuario char(10) not null,
clave char(4) not null,
fecha_registro timestamp default CURRENT_TIMESTAMP,
id_persona int not null,
CONSTRAINT pk_usuario PRIMARY key (id_usuario),
CONSTRAINT fk_usuario_persona foreign key (id_persona) references persona(id_persona)
);

create TABLE tema (
id_tema int AUTO_INCREMENT not null,
nombre varchar (100) not null,
nota_final real not null,
CONSTRAINT pk_tema PRIMARY key (id_tema)
);

create TABLE subtema (
id_subtema int AUTO_INCREMENT not null,
nombre varchar (100) not null,
nota real not null,
id_tema int not null,
CONSTRAINT pk_subtema PRIMARY key (id_subtema),
CONSTRAINT fk_subtema_tema foreign key (id_tema) references tema(id_tema)
);

create TABLE test (
id_test int AUTO_INCREMENT not null,
nota real not null,
tiempo int not null,
id_tipo_test int not null,
id_subtema int not null,
CONSTRAINT pk_test PRIMARY key (id_test),
CONSTRAINT fk_test_subtema foreign key (id_subtema) references subtema(id_subtema),
CONSTRAINT fk_test_tipo_test foreign key (id_tipo_test) references tipo_test(id_tipo_test)
);

create TABLE subtemahueso (
id_subtema int not null,
id_hueso int not null,
CONSTRAINT pk_subtemahueso PRIMARY key (id_subtema, id_hueso),
CONSTRAINT fk_subtemahueso_subtema foreign key (id_subtema) references subtema(id_subtema),
CONSTRAINT fk_subtemahueso_hueso foreign key (id_hueso) references hueso(id_hueso)
);

create TABLE periodo_usuario (
id_periodo int not null,
id_usuario char(10) not null,
id_tema int not null,
fecha_inscripcion date not null,
CONSTRAINT pk_periodo_usuario PRIMARY key (id_periodo, id_usuario, id_tema),
CONSTRAINT fk_periodo_usuario_periodo foreign key (id_periodo) references periodo(id_periodo),
CONSTRAINT fk_periodo_usuario_usuario foreign key (id_usuario) references usuario(id_usuario),
CONSTRAINT fk_periodo_usuario_tema foreign key (id_tema) references tema(id_tema)
);

alter table usuario add column estado char (1) not null;
alter table test add column estado char (1) not null;
alter table hueso add column nombre varchar (100) not null;

create TABLE opcion (
id_opcion int AUTO_INCREMENT not null,
descripcion varchar (100) not null,
valor char (1) not null,
CONSTRAINT pk_opcion PRIMARY key (id_opcion)
);

create TABLE pregunta (
id_pregunta int AUTO_INCREMENT not null,
descripcion varchar (500) not null,
puntaje real not null,
CONSTRAINT pk_pregunta PRIMARY key (id_pregunta)
);

create TABLE opcionpregunta (
id_opcion int not null,
id_pregunta int not null,
CONSTRAINT pk_opcionpregunta PRIMARY key (id_opcion, id_pregunta),
CONSTRAINT fk_opcionpregunta_opcion foreign key (id_opcion) references opcion(id_opcion),
CONSTRAINT fk_opcionpregunta_pregunta foreign key (id_pregunta) references pregunta(id_pregunta)
);

create TABLE preguntatest (
id_pregunta int not null,
id_test int not null,
CONSTRAINT pk_pregunta PRIMARY key (id_test, id_pregunta),
CONSTRAINT fk_pregunta_test foreign key (id_test) references test(id_test),
CONSTRAINT fk_pregunta_pregunta foreign key (id_pregunta) references pregunta(id_pregunta)
);

alter table usuario modify column estado char(1) not null default 'A';
alter table usuario modify column clave char(32) not null;
alter table tipo_persona modify column nombre varchar(20) not null;

insert into tipo_persona values(1,'Administrador');
insert into persona values('131td43154','Vásquez','Pacheco','Raúl M.','M','1993-06-12','969105301',1);
insert into usuario (id_usuario,clave,id_persona) values(1,'81dc9bdb52d04dc20036dbd8313ed055','131td43154');
