/** @jsx h */
import { h } from "preact";
import { PageProps, Handlers } from "$fresh/server.ts";
import NavBar from "../islands/Navbar.tsx";
import Footer from "../islands/Footer.tsx";
import { Head } from "$fresh/runtime.ts";
import { ObtainCurrentUrl } from "../common/nav-bar-functionality.ts";

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

export default function About({ data }: PageProps<Data>) {
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
      About
      <Footer props={{ path: data.url.pathname }} />
    </div>
  );
}
