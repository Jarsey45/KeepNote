--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2 (Debian 16.2-1.pgdg120+2)
-- Dumped by pg_dump version 16.2 (Debian 16.2-1.pgdg120+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: kn_notes; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.kn_notes (
    id bigint NOT NULL,
    id_owner bigint NOT NULL,
    title character varying(50) NOT NULL,
    content text NOT NULL,
    color character varying(10) NOT NULL,
    date_created date DEFAULT now() NOT NULL
);


ALTER TABLE public.kn_notes OWNER TO docker;

--
-- Name: kn_notes_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.kn_notes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kn_notes_id_seq OWNER TO docker;

--
-- Name: kn_notes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.kn_notes_id_seq OWNED BY public.kn_notes.id;


--
-- Name: kn_roles; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.kn_roles (
    id bigint NOT NULL,
    name character varying(50) NOT NULL,
    privileges character varying(4) NOT NULL
);


ALTER TABLE public.kn_roles OWNER TO docker;

--
-- Name: COLUMN kn_roles.privileges; Type: COMMENT; Schema: public; Owner: docker
--

COMMENT ON COLUMN public.kn_roles.privileges IS 'create, edit, view, delete';


--
-- Name: kn_roles_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.kn_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kn_roles_id_seq OWNER TO docker;

--
-- Name: kn_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.kn_roles_id_seq OWNED BY public.kn_roles.id;


--
-- Name: kn_shared; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.kn_shared (
    id bigint NOT NULL,
    id_note bigint NOT NULL,
    id_shared_user bigint NOT NULL
);


ALTER TABLE public.kn_shared OWNER TO docker;

--
-- Name: kn_shared2_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.kn_shared2_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kn_shared2_id_seq OWNER TO docker;

--
-- Name: kn_shared2_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.kn_shared2_id_seq OWNED BY public.kn_shared.id;


--
-- Name: kn_users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.kn_users (
    id bigint NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(50) NOT NULL,
    password character varying(150) NOT NULL,
    id_role bigint NOT NULL,
    date_created date DEFAULT now() NOT NULL
);


ALTER TABLE public.kn_users OWNER TO docker;

--
-- Name: kn_users_id_privileges_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.kn_users_id_privileges_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kn_users_id_privileges_seq OWNER TO docker;

--
-- Name: kn_users_id_privileges_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.kn_users_id_privileges_seq OWNED BY public.kn_users.id_role;


--
-- Name: kn_users_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.kn_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.kn_users_id_seq OWNER TO docker;

--
-- Name: kn_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.kn_users_id_seq OWNED BY public.kn_users.id;


--
-- Name: kn_notes id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_notes ALTER COLUMN id SET DEFAULT nextval('public.kn_notes_id_seq'::regclass);


--
-- Name: kn_roles id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_roles ALTER COLUMN id SET DEFAULT nextval('public.kn_roles_id_seq'::regclass);


--
-- Name: kn_shared id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_shared ALTER COLUMN id SET DEFAULT nextval('public.kn_shared2_id_seq'::regclass);


--
-- Name: kn_users id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_users ALTER COLUMN id SET DEFAULT nextval('public.kn_users_id_seq'::regclass);


--
-- Name: kn_notes kn_notes_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_notes
    ADD CONSTRAINT kn_notes_pkey PRIMARY KEY (id_owner);


--
-- Name: kn_roles kn_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_roles
    ADD CONSTRAINT kn_roles_pkey PRIMARY KEY (id);


--
-- Name: kn_shared kn_shared2_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_shared
    ADD CONSTRAINT kn_shared2_pkey PRIMARY KEY (id_note);


--
-- Name: kn_users kn_users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.kn_users
    ADD CONSTRAINT kn_users_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

