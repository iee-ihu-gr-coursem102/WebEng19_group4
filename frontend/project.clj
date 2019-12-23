(defproject wewe "0.1.0-SNAPSHOT"
  :dependencies [[org.clojure/clojure "1.10.1"]
                 [org.clojure/clojurescript "1.10.520"
                  :exclusions [com.google.javascript/closure-compiler-unshaded
                               org.clojure/google-closure-library]]
                 [thheller/shadow-cljs "2.8.69"]
                 [reagent "0.8.1"]
                 [re-frame "0.10.9"]
                 [day8.re-frame/http-fx "0.1.6"]
                 [secretary "1.2.3"]
                 [compojure "1.6.1"]
                 [yogthos/config "1.1.6"]
                 [ring "1.7.1"]
                 [ring/ring-defaults "0.3.2"]
                 [ring-logger "1.0.1"]
                 [org.clojure/tools.logging "0.5.0"]
                 [clj-time "0.15.2"]                        ;; required by defaults
                 [cheshire "5.9.0"]
                 [com.taoensso/carmine "2.19.1"]]

  :plugins [
            [lein-less "1.7.5"]
            [lein-shell "0.5.0"]]

  :min-lein-version "2.5.3"

  :source-paths ["src/clj" "src/cljs"]

  :test-paths   ["test/cljs"]

  :clean-targets ^{:protect false} ["resources/public/js/compiled" "target"
                                    "test/js"]


  :less {:source-paths ["less"]
         :target-path  "resources/public/css"}

  :shell {:commands {"open" {:windows ["cmd" "/c" "start"]
                             :macosx  "open"
                             :linux   "xdg-open"}}}

  :aliases {"dev"          ["with-profile" "dev" "do"
                            ["clean"]
                            ["run" "-m" "shadow.cljs.devtools.cli" "watch" "app"]]
            "prod"         ["with-profile" "prod" "do"
                            ["run" "-m" "shadow.cljs.devtools.cli" "release" "app"]]
            "build-report" ["with-profile" "prod" "do"
                            ["clean"]
                            ["run" "-m" "shadow.cljs.devtools.cli" "run" "shadow.cljs.build-report" "app" "target/build-report.html"]
                            ["shell" "open" "target/build-report.html"]]
            "karma"        ["with-profile" "prod" "do"
                            ["clean"]
                            ["run" "-m" "shadow.cljs.devtools.cli" "compile" "karma-test"]
                            ["shell" "karma" "start" "--single-run" "--reporters" "junit,dots"]]}

  :profiles
  {:dev
   {:dependencies [[binaryage/devtools "0.9.10"]
                   [day8.re-frame/re-frame-10x "0.4.5"]
                   [day8.re-frame/tracing "0.5.3"]]}

   :prod { :dependencies [[day8.re-frame/tracing-stubs "0.5.3"]]}

   :uberjar {:source-paths ["env/prod/clj"]
             :dependencies [[day8.re-frame/tracing-stubs "0.5.3"]]
             :omit-source  true
             :main         wewe.server
             :aot          [wewe.server]
             :uberjar-name "wewe.jar"
             :prep-tasks   ["compile" ["prod"]["less" "once"]]}
   })
