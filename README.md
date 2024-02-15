# PHPython
This plugin allows you to use Python with PHP on PocketMine-MP.

## How To Use

Create a Python file in the plugin_data/PHPython folder, with any name, but ending with .py, then you need to insert the name into the config.yml.

## welcome.py

```python
import base64
import json
import sys

class Player:

    def __init__(self, args: str):

        self.args = json.loads(base64.b64decode(args))['getPlayer']

    def getName(self) -> str:
        return self.args['getName']

class PHPython:

    def __init__(self) -> None:

        if len(sys.argv) > 1:
            self.event = sys.argv[1].split('\\').pop()
            self.player = sys.argv[2]

            if self.event in dir(self.__class__):
                getattr(self, self.event)(Player(self.player))

    @staticmethod
    def output(msg: str) -> None:
        print(base64.b64encode(msg.encode("utf-8")).decode())

    def PlayerJoinEvent(self, player: Player) -> str:
        self.output(f'§8[§a+§8] §a{player.getName()}')

    def PlayerQuitEvent(self, player: Player) -> str:
        self.output(f'§8[§c-§8] §c{player.getName()}')

PHPython()
```

# ⚠️WARNING ⚠️

This plugin is not suitable for serious projects, it was created out of boredom, in case anyone wants to turn it into something serious they are free to use this code as a basis.
