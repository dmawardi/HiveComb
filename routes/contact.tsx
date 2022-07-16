/** @jsx h */
import { h } from "preact";
import { Handlers, PageProps } from "$fresh/server.ts";
import NavBar from "../islands/Navbar.tsx";
import Footer from "../islands/Footer.tsx";
import { Head } from "$fresh/runtime.ts";
import { ObtainCurrentUrl } from "../common/nav-bar-functionality.ts";

const NAMES = ["Alice", "Bob", "Charlie", "Dave", "Eve", "Frank"];

interface Data {
  url: URL;
}

export const handler: Handlers<Data> = {
  GET(req, ctx) {
    // const query = url.searchParams.get("q") || "";
    // const results = NAMES.filter((name) => name.includes(query));
    // return ctx.render({ results, query });
    // Obtain the current URL and provide to navbar
    const url = ObtainCurrentUrl(req, ctx);
    return ctx.render({ url });
  },
};

export default function Contact({ data }: PageProps<Data>) {
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

      {/* <form>
        <input type="text" name="q" value={query} />
        <button type="submit">Search</button>
      </form> */}
      {/* <ul>
        {results.map((name) => (
          <li key={name}>{name}</li>
        ))}
      </ul> */}
      <Footer props={{ path: data.url.pathname }} />
    </div>
  );
}
