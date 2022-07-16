/** @jsx h */
import { h } from "preact";
import Counter from "../islands/Counter.tsx";
import { Head } from "$fresh/runtime.ts";
import NavBar from "../islands/Navbar.tsx";
import Footer from "../islands/Footer.tsx";
import { ObtainCurrentUrl } from "../common/nav-bar-functionality.ts";
import { Handlers, PageProps } from "$fresh/server.ts";

interface Data {
  url: URL;
}

export const handler: Handlers<Data> = {
  GET(req, ctx) {
    // Obtain the current URL and provide to navbar
    const url = ObtainCurrentUrl(req, ctx);
    return ctx.render({ url });
  },
};

export default function Home({ data }: PageProps<Data>) {
  return (
    <div>
      <Head>
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
          crossorigin="anonymous"
        ></link>
      </Head>
      <NavBar props={{ url: data.url.pathname }} />
      <img
        src="/logo.svg"
        height="100px"
        alt="the fresh logo: a sliced lemon dripping with juice"
      />
      <p>
        Welcome to `Fresh Hashish`. Try update this message in the
        ./routes/index.tsx file, and refresh.
      </p>
      <Counter start={3} />
      <Footer props={{ path: data.url.pathname }} />
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"
      ></script>
    </div>
  );
}
