--
-- PostgreSQL database dump
--

-- Dumped from database version 10.4 (Ubuntu 10.4-0ubuntu0.18.04)
-- Dumped by pg_dump version 10.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: sq_lancamentos; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sq_lancamentos
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 922337203
    CACHE 1;


ALTER TABLE public.sq_lancamentos OWNER TO postgres;

--
-- Name: lancamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lancamentos (
    id integer DEFAULT nextval('public.sq_lancamentos'::regclass) NOT NULL,
    id_user integer NOT NULL,
    descricao character varying(2044) NOT NULL,
    data date NOT NULL,
    valor numeric(7,2) NOT NULL,
    tipo character(1) NOT NULL
);


ALTER TABLE public.lancamentos OWNER TO postgres;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: sq_tags; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sq_tags
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 922337203
    CACHE 1;


ALTER TABLE public.sq_tags OWNER TO postgres;

--
-- Name: sq_tarefas; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sq_tarefas
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 922337203
    CACHE 1;


ALTER TABLE public.sq_tarefas OWNER TO postgres;

--
-- Name: tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags (
    id integer DEFAULT nextval('public.sq_tags'::regclass) NOT NULL,
    id_user integer NOT NULL,
    tag character varying(200) NOT NULL
);


ALTER TABLE public.tags OWNER TO postgres;

--
-- Name: tags_x_lancamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags_x_lancamentos (
    id_tag integer NOT NULL,
    id_lancamento integer NOT NULL
);


ALTER TABLE public.tags_x_lancamentos OWNER TO postgres;

--
-- Name: tags_x_tarefas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags_x_tarefas (
    id_tag integer NOT NULL,
    id_tarefa integer NOT NULL
);


ALTER TABLE public.tags_x_tarefas OWNER TO postgres;

--
-- Name: tarefas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tarefas (
    id integer DEFAULT nextval('public.sq_tarefas'::regclass) NOT NULL,
    id_user integer NOT NULL,
    tarefa character varying(2044) NOT NULL,
    data date NOT NULL,
    cumprido smallint NOT NULL
);


ALTER TABLE public.tarefas OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: lancamentos lancamentos_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lancamentos
    ADD CONSTRAINT lancamentos_id_key UNIQUE (id);


--
-- Name: lancamentos lancamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lancamentos
    ADD CONSTRAINT lancamentos_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: tags tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_pkey PRIMARY KEY (id);


--
-- Name: tarefas tarefas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarefas
    ADD CONSTRAINT tarefas_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: lancamentos_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX lancamentos_id_idx ON public.lancamentos USING btree (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- PostgreSQL database dump complete
--

