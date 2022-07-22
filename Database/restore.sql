--
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 13.4
-- Dumped by pg_dump version 13.4

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

DROP DATABASE "Musicure";
--
-- Name: Musicure; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "Musicure" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';


ALTER DATABASE "Musicure" OWNER TO postgres;

\connect "Musicure"

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

--
-- Name: DATABASE "Musicure"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE "Musicure" IS 'Music player ';


--
-- Name: checkpalindrome(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.checkpalindrome(num integer, OUT result character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
DECLARE 
	rev INTEGER := 0;
	rem INTEGER := 0;
	tem INTEGER := num;
	
BEGIN
	while (tem > 0) LOOP
		rem = tem%10;
		rev = (rev*10) + rem;
		tem = tem/10;
	
	END LOOP;
	
	if num = rev THEN
	result = 'palindrome';
	ELSE
	result = 'Not palindrome';
	END IF;
	
	RETURN;
	END
$$;


ALTER FUNCTION public.checkpalindrome(num integer, OUT result character varying) OWNER TO postgres;

--
-- Name: discover_weekly(date); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.discover_weekly(lastchanged date) RETURNS date
    LANGUAGE plpgsql
    AS $$
DECLARE 
	latestDate DATE := NOW()::date;
	dayDiff INT;
	
	BEGIN
	
	dayDiff = latestDate - lastChanged;
	
	IF(dayDiff > 7) THEN
		RETURN latestDate;
	ELSE
		RETURN lastChanged;
	END IF;
	
	END;
$$;


ALTER FUNCTION public.discover_weekly(lastchanged date) OWNER TO postgres;

--
-- Name: new_user_song_update(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.new_user_song_update() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

DECLARE
	songId INT;

BEGIN
		SELECT floor(random() * (SELECT MAX(songs.songId) FROM songs) + 1)::int INTO songId;
		INSERT INTO	
		userSong(userId , songId)
		VALUES (NEW.userId , songId);
		
	RETURN NEW;
END;
$$;


ALTER FUNCTION public.new_user_song_update() OWNER TO postgres;

--
-- Name: palindrome_number(numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.palindrome_number(num numeric, OUT result character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
DECLARE
tem INTEGER := num;
rev INTEGER := 0;
rem INTEGER := 0;
BEGIN
WHILE tem>0 LOOP
rem = tem%10;
rev = (rev*10) + rem;
tem = tem/10;
END LOOP;
IF rev = num THEN
result = 'The number is a Palindrome';
ELSE
result = 'The number is not a Palindrome';
END IF;
RETURN;
END
$$;


ALTER FUNCTION public.palindrome_number(num numeric, OUT result character varying) OWNER TO postgres;

--
-- Name: rev(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.rev(num integer, OUT result character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
DECLARE 
	rem INTEGER := 0;
	rev INTEGER := 0;
	tem INTEGER := num;
	
BEGIN
	while(tem > 0)
	LOOP
	rem = tem%10;
	rev = (rev*10) + rem;
	tem = tem/10;
	END LOOP;
	result = 'Reverse : ' ||rev;
	RETURN;
	END
$$;


ALTER FUNCTION public.rev(num integer, OUT result character varying) OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: album; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.album (
    albumid integer NOT NULL,
    albumname character varying(500) NOT NULL,
    albumimgloc character varying
);


ALTER TABLE public.album OWNER TO postgres;

--
-- Name: artists; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.artists (
    artistid integer NOT NULL,
    artistname character varying(250) NOT NULL,
    artistdescription character varying(500) NOT NULL
);


ALTER TABLE public.artists OWNER TO postgres;

--
-- Name: composers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.composers (
    composerid integer NOT NULL,
    composername character varying(500) NOT NULL,
    composerdescription character varying(1000) NOT NULL
);


ALTER TABLE public.composers OWNER TO postgres;

--
-- Name: discover; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.discover (
    lastupdated date NOT NULL
);


ALTER TABLE public.discover OWNER TO postgres;

--
-- Name: favorites; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.favorites (
    userid integer NOT NULL,
    songid integer NOT NULL
);


ALTER TABLE public.favorites OWNER TO postgres;

--
-- Name: songartist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.songartist (
    artistid integer NOT NULL,
    songid integer NOT NULL
);


ALTER TABLE public.songartist OWNER TO postgres;

--
-- Name: songcomposer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.songcomposer (
    composerid integer NOT NULL,
    songid integer NOT NULL
);


ALTER TABLE public.songcomposer OWNER TO postgres;

--
-- Name: songs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.songs (
    songid integer NOT NULL,
    songname character varying(255) NOT NULL,
    songlanguage character varying(100) NOT NULL,
    duration time without time zone NOT NULL,
    albumid integer NOT NULL,
    genre character varying(200) NOT NULL,
    songaudioloc character varying
);


ALTER TABLE public.songs OWNER TO postgres;

--
-- Name: theme; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.theme (
    themeid integer NOT NULL,
    themename character varying(500) NOT NULL,
    themelanguage character varying(100) NOT NULL,
    themegenre character varying(100) NOT NULL,
    themeimgloc character varying
);


ALTER TABLE public.theme OWNER TO postgres;

--
-- Name: themesongs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.themesongs (
    themeid integer NOT NULL,
    songid integer NOT NULL
);


ALTER TABLE public.themesongs OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    userid integer NOT NULL,
    username character varying(500) NOT NULL,
    usercountry character varying(100) NOT NULL,
    userstate character varying(100) NOT NULL,
    usercity character varying(100) NOT NULL,
    useremail character varying(250) NOT NULL,
    usermobile character varying(15) NOT NULL,
    userpassword character varying(50) NOT NULL,
    languagepreference character varying
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: usersong; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usersong (
    userid integer NOT NULL,
    songid integer NOT NULL
);


ALTER TABLE public.usersong OWNER TO postgres;

--
-- Data for Name: album; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.album (albumid, albumname, albumimgloc) FROM stdin;
\.
COPY public.album (albumid, albumname, albumimgloc) FROM '$$PATH$$/3069.dat';

--
-- Data for Name: artists; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.artists (artistid, artistname, artistdescription) FROM stdin;
\.
COPY public.artists (artistid, artistname, artistdescription) FROM '$$PATH$$/3067.dat';

--
-- Data for Name: composers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.composers (composerid, composername, composerdescription) FROM stdin;
\.
COPY public.composers (composerid, composername, composerdescription) FROM '$$PATH$$/3070.dat';

--
-- Data for Name: discover; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.discover (lastupdated) FROM stdin;
\.
COPY public.discover (lastupdated) FROM '$$PATH$$/3077.dat';

--
-- Data for Name: favorites; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.favorites (userid, songid) FROM stdin;
\.
COPY public.favorites (userid, songid) FROM '$$PATH$$/3076.dat';

--
-- Data for Name: songartist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.songartist (artistid, songid) FROM stdin;
\.
COPY public.songartist (artistid, songid) FROM '$$PATH$$/3068.dat';

--
-- Data for Name: songcomposer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.songcomposer (composerid, songid) FROM stdin;
\.
COPY public.songcomposer (composerid, songid) FROM '$$PATH$$/3071.dat';

--
-- Data for Name: songs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.songs (songid, songname, songlanguage, duration, albumid, genre, songaudioloc) FROM stdin;
\.
COPY public.songs (songid, songname, songlanguage, duration, albumid, genre, songaudioloc) FROM '$$PATH$$/3066.dat';

--
-- Data for Name: theme; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.theme (themeid, themename, themelanguage, themegenre, themeimgloc) FROM stdin;
\.
COPY public.theme (themeid, themename, themelanguage, themegenre, themeimgloc) FROM '$$PATH$$/3072.dat';

--
-- Data for Name: themesongs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.themesongs (themeid, songid) FROM stdin;
\.
COPY public.themesongs (themeid, songid) FROM '$$PATH$$/3073.dat';

--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (userid, username, usercountry, userstate, usercity, useremail, usermobile, userpassword, languagepreference) FROM stdin;
\.
COPY public.users (userid, username, usercountry, userstate, usercity, useremail, usermobile, userpassword, languagepreference) FROM '$$PATH$$/3074.dat';

--
-- Data for Name: usersong; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usersong (userid, songid) FROM stdin;
\.
COPY public.usersong (userid, songid) FROM '$$PATH$$/3075.dat';

--
-- Name: album album_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album
    ADD CONSTRAINT album_pkey PRIMARY KEY (albumid);


--
-- Name: artists artists_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artists
    ADD CONSTRAINT artists_pk PRIMARY KEY (artistid);


--
-- Name: composers composers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.composers
    ADD CONSTRAINT composers_pkey PRIMARY KEY (composerid);


--
-- Name: favorites favorites_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.favorites
    ADD CONSTRAINT favorites_pkey PRIMARY KEY (userid, songid);


--
-- Name: songartist songartist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songartist
    ADD CONSTRAINT songartist_pkey PRIMARY KEY (songid, artistid);


--
-- Name: songcomposer songcomposer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songcomposer
    ADD CONSTRAINT songcomposer_pkey PRIMARY KEY (songid, composerid);


--
-- Name: songs songs_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songs
    ADD CONSTRAINT songs_pk PRIMARY KEY (songid);


--
-- Name: theme theme_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.theme
    ADD CONSTRAINT theme_pkey PRIMARY KEY (themeid);


--
-- Name: themesongs themesongs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.themesongs
    ADD CONSTRAINT themesongs_pkey PRIMARY KEY (themeid, songid);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (userid);


--
-- Name: usersong usersong_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usersong
    ADD CONSTRAINT usersong_pkey PRIMARY KEY (userid, songid);


--
-- Name: users new_user_song; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER new_user_song AFTER INSERT ON public.users FOR EACH ROW EXECUTE FUNCTION public.new_user_song_update();


--
-- Name: favorites favorites_songid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.favorites
    ADD CONSTRAINT favorites_songid_fkey FOREIGN KEY (songid) REFERENCES public.songs(songid);


--
-- Name: favorites favorites_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.favorites
    ADD CONSTRAINT favorites_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- Name: songartist songartist_artistid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songartist
    ADD CONSTRAINT songartist_artistid_fkey FOREIGN KEY (artistid) REFERENCES public.artists(artistid);


--
-- Name: songartist songartist_songid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songartist
    ADD CONSTRAINT songartist_songid_fkey FOREIGN KEY (songid) REFERENCES public.songs(songid);


--
-- Name: songcomposer songcomposer_composerid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songcomposer
    ADD CONSTRAINT songcomposer_composerid_fkey FOREIGN KEY (composerid) REFERENCES public.composers(composerid);


--
-- Name: songcomposer songcomposer_songid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.songcomposer
    ADD CONSTRAINT songcomposer_songid_fkey FOREIGN KEY (songid) REFERENCES public.songs(songid);


--
-- Name: themesongs themesongs_songid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.themesongs
    ADD CONSTRAINT themesongs_songid_fkey FOREIGN KEY (songid) REFERENCES public.songs(songid);


--
-- Name: themesongs themesongs_themeid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.themesongs
    ADD CONSTRAINT themesongs_themeid_fkey FOREIGN KEY (themeid) REFERENCES public.theme(themeid);


--
-- Name: usersong usersong_songid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usersong
    ADD CONSTRAINT usersong_songid_fkey FOREIGN KEY (songid) REFERENCES public.songs(songid);


--
-- Name: usersong usersong_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usersong
    ADD CONSTRAINT usersong_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- PostgreSQL database dump complete
--

