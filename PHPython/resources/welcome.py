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